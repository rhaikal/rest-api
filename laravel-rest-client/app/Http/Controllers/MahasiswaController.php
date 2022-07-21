<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::myAPI()->get('/mahasiswas');    
        $mahasiswa = $response->collect('data');

        return view('mahasiswa.index', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nrp' => 'required|max:9',
            'nama' => 'required',
            'email' => 'required|email',
            'jurusan' => 'required'
        ]);

        $response = Http::myAPI()->post('/mahasiswas', [
            'form_params' => $validatedData
        ]);

        if($response->successful()) {
            return redirect('/mahasiswa')->with('success', 'Berhasil menambahkan mahasiswa baru!');
        } else if ($response->status() === 429) {
            return redirect('/mahasiswa')->with('error', 'Fungsi menambahkan data telah mencapai batas!');
        } else {
            return redirect('/mahasiswa')->with('error', 'Gagal menambahkan mahasiswa baru!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
