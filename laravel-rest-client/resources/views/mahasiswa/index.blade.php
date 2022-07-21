@extends('layouts.main')

@section('container')
    <div class="container mt-3">
        <div class="row mt-3">
            <div class="col-md-6">
                <a href="{{ url()->current() }}/create" class="btn btn-primary">Tambah
                    Data Mahasiswa</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari data mahasiswa.." name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <h3>Daftar Mahasiswa</h3>
                @if($mahasiswa->isEmpty())
                    <div class="alert alert-danger" role="alert">
                    data mahasiswa tidak ditemukan.
                    </div>
                @else
                    <ul class="list-group">
                        @foreach ($mahasiswa as $mhs)
                    <li class="list-group-item">
                        {{ $mhs['nama'] }}
                        <a href="{{ url()->current() }}/{{ $mhs['id'] }}"
                            class="badge bg-danger float-end text-decoration-none">hapus</a>
                        <a href="{{ url()->current() }}/{{ $mhs['id'] }}/edit"
                            class="badge bg-success float-end text-decoration-none">ubah</a>
                        <a href="{{ url()->current() }}/{{ $mhs['id'] }}"
                            class="badge bg-primary float-end text-decoration-none">detail</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

    </div>
@endsection