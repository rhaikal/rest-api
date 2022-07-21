@extends('layouts.main')

@section('container')
    <div class="container mt-3">

        <div class="row mt-3">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        Form Tambah Data Mahasiswa
                    </div>
                    <div class="card-body">
                        <form action="/mahasiswa" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" required autofocus value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror    
                            </div>
                            <div class="form-group mt-3">
                                <label for="nrp">NRP</label>
                                <input type="text" name="nrp" class="form-control @error('nrp') is-invalid @enderror" id="nrp" required value="{{ old('nrp') }}">
                                @error('nrp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror        
                            </div>
                            <div class="form-group mt-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="jurusan">Jurusan</label>
                                <select class="form-control" id="jurusan" name="jurusan">
                                    <option value="Teknik Informatika" @if (old('jurusan') === 'Teknik Informatika')
                                        selected
                                    @endif>Teknik Informatika</option>
                                    <option value="Teknik Industri"@if (old('jurusan') === 'Teknik Industri')
                                        selected
                                    @endif>Teknik Industri</option>
                                    <option value="Teknik Pangan"@if (old('jurusan') === 'Teknik Pangan')
                                        selected
                                    @endif>Teknik Pangan</option>
                                    <option value="Teknik Mesin"@if (old('jurusan') === 'Teknik Mesin')
                                        selected
                                    @endif>Teknik Mesin</option>
                                    <option value="Teknik Planologi"@if (old('jurusan') === 'Teknik Planologi')
                                        selected
                                    @endif>Teknik Planologi</option>
                                    <option value="Teknik Lingkungan"@if (old('jurusan') === 'Teknik Lingkungan')
                                        selected
                                    @endif>Teknik Lingkungan</option>
                                </select>
                            </div>
                            <button type="submit" name="tambah" class="btn btn-primary mt-3">Tambah Data</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection