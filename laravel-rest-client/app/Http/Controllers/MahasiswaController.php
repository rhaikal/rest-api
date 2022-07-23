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
        $mahasiswa = $this->all();

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
        $mahasiswa = $this->all();

        if($mahasiswa->contains('nrp', '===', $request->nrp)){
            return back()->withErrors(['nrp' => 'The nrp has already been taken.']);
        }

        $validatedData = $request->validate([
            'nrp' => 'required|max:9',
            'nama' => 'required',
            'email' => 'required|email',
            'jurusan' => 'required'
        ]);


        $response = Http::myAPI()->post('/mahasiswas', $validatedData);

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
        $mahasiswa = $this->get($id);

        return view('mahasiswa.show', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = $this->get($id);

        return view('mahasiswa.edit', [
            'mahasiswa' => $mahasiswa
        ]);
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
        $mahasiswa = $this->get($id);

        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'jurusan' => 'required'
        ];

        if($request->nrp != $mahasiswa['nrp']) {
            $rules['nrp'] = 'required';
        }
    
        $validatedData = $request->validate($rules);

        $response = Http::myAPI()->put('/mahasiswas/'. $id, $validatedData);

        if($response->successful()){
            return redirect('/mahasiswa')->with('success', 'Berhasil mengubah data mahasiswa!');
        } else {
            return redirect('/mahasiswa')->with('error', 'Gagal mengubah data mahasiswa');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::myAPI()->delete('/mahasiswas/'. $id);

        if($response->successful()){
            return redirect('/mahasiswa')->with('success', 'Berhasil menghapus data mahasiswa!');
        } else {
            return redirect('/mahasiswa')->with('error', 'Gagal menghapus data mahasiswa!');
        }
    }

    /**
     * Get all mahasiswa from rest-server.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all() {
        $response = Http::myAPI()->get('/mahasiswas');    
        return $response->collect('data');
    }
    
    /**
     * Get specified mahasiswa from rest-server.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function get($id) {
        $response = Http::myAPI()->get('/mahasiswas/' . $id);    
        return $response->collect('data');
    }
}
