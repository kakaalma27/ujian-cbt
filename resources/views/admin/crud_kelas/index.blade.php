@extends('layouts.admin')
@section('title', 'kelas')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card bg-white border-0" style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
                    <div class="card-header bg-dark text-light">
                        <h1>Kelas</h1>
                    </div>
                    <div class="card-body">
                      <div class="col-md-4">
                        <a href="{{ route('kelas.create') }}" class="btn btn-dark mb-2">Tambah Kelas</a>
                        <a href="{{ route('admin.anggota') }}" class="btn btn-dark mb-2">Tambah Siswa</a>
                    </div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama kelas</th>
                                <th scope="col">Jumlah Siswa</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                @foreach ($kelas as $kelasName)                                  
                                <th scope="row">{{ $loop->iteration }}</th>
                                  <td>{{ $kelasName->nama_kelas }}</td>
                                @endforeach
                                @foreach ($jumlahSiswa as $siswa)                                  
                                  <td>{{ $siswa }}</td>
                                @endforeach
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="card border-0 bg-white">
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kelas</th>
                        <th scope="col">Nama Siswa</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
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