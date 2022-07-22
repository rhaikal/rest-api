<?php

namespace App\Http\Controllers\Api;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();

        return new MahasiswaResource(true, 'List Data Mahasiswa', $mahasiswa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nrp' => 'required|min:9|unique:mahasiswa',
            'nama' => 'required',
            'email' => 'required',
            'jurusan' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Data Mahasiswa',
                'errors' => $validator->errors()
            ], 422);
        }

        $mahasiswa = Mahasiswa::create([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ]);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Ditambahkan!', $mahasiswa);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return new MahasiswaResource(true, 'Data Mahasiswa Ditemukan!', $mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required',
            'jurusan' => 'required'
        ];
        
        if($request->nrp){
            $rules['nrp'] = 'required|min:9|unique:mahasiswa';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Mengubah Data Mahasiswa',
                'errors' => $validator->errors()
            ], 422);
        }
       
        $validated = $validator->validated();

        $mahasiswa->update($validated);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diubah!', $mahasiswa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Dihapus!');
    }

    public function search($nama)
    {
       $search = Mahasiswa::where('nama', 'like', "%$nama%")->get();

       return New MahasiswaResource(true, 'Data Mahasiswa Ditemukan!', $search);
    }
}
