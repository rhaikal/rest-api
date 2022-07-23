@extends('layouts.main')

@section('container')
    <div class="container mt-3">
        @if (session('success'))
            <div class="row mt-3">
                <div class="alert alert-success col-md-6" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        @elseif (session('error'))
            <div class="row mt-3">
                <div class="alert alert-danger col-md-6" role="alert">
                    {{ session('error') }}
                </div>
            </div>
        @endif  
        
        <div class="row mt-3">
            <div class="col-md-6">
                <a href="/mahasiswa/create" class="btn btn-primary">Tambah
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
                                <form action="/mahasiswa/{{ $mhs['id'] }}" method="post" class="float-end">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="badge bg-danger float-end text-decoration-none border border-0" onclick="return confirm('Ingin menghapus data?')"> hapus</button>
                                </form>
                                <a href="/mahasiswa/{{ $mhs['id'] }}/edit"
                                    class="badge bg-success float-end text-decoration-none">ubah</a>
                                <a href="/mahasiswa/{{ $mhs['id'] }}"
                                    class="badge bg-primary float-end text-decoration-none">detail</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

    </div>
    <script>
        $('.list-group').on('mouseenter', 'button.badge', function(event) {
            var elem = $(this);
            elem.addClass('text-primary');
        });

        $('.list-group').on('mouseleave', 'button.badge', function(event) {
            var elem = $(this);
            elem.removeClass('text-primary');
        });

        // const buttons = document.querySelectorAll("button[type=submit].badge");

        // buttons.forEach(button =>{
        //     button.addEventListener('mouseenter', (event) => {
        //         button.classList.add("text-primary");
        //     });
    
        //     button.addEventListener('mouseleave', (event) => {
        //         button.classList.remove('text-primary');
        //     });
        // });
    </script>
@endsection