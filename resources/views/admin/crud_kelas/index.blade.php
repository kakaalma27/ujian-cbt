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
                      <div class="col-md">
                        <a href="{{ route('kelas.create') }}" class="btn btn-dark">Tambah Kelas</a>
                    </div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama kelas</th>
                                <th scope="col">User id</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($kelas as $kelasName)                                  
                              <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $kelasName->id_kelas }}</td>
                                <td>{{ $kelasName->nama_kelas }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h1>Siswa</h1>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Jenis Kelamin</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection