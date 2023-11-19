@extends('layouts.admin')
@section('title', 'Pelajaran')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h1>Pelajaran</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('pelajaran.create') }}" class="btn btn-dark">Tambah Data</a>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Pelajaran</th>
                                    <th scope="col">Kode Akses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelajarans as $key => $pelajaran)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $pelajaran->user->name }}</td>
                                        <td>{{ $pelajaran->pelajaran }}</td>
                                        <td>{{ $pelajaran->kode_akses }}</td>
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