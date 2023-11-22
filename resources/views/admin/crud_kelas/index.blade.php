@extends('layouts.admin')
@section('title', 'kelas')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h1>Kelas</h1>
                    </div>
                    <div class="card-body">
                      <div class="col-md-4">
                        <a href="{{ route('kelas.create') }}" class="btn btn-dark">Tambah Kelas</a>
                        <a href="{{ route('admin.anggota') }}" class="btn btn-dark">Tambah anggota</a>
                    </div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama kelas</th>
                                <th scope="col">Lihat Siswa</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($kelas as $kelasName)                                  
                              <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $kelasName->nama_kelas }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection