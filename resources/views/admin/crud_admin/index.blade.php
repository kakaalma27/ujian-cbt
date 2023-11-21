@extends('layouts.admin')
@section('title', 'Account')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-light">
                    <div class="card-header bg-dark text-light">
                        <label class="fs-4 fw-bold">Informasi Account</label>
                    </div>
                    <div class="card-body">
                        <div class="row py-2">
                            <div class="col-md-2">
                                <a href="{{ route('account.create') }}" class="btn btn-dark">Tambah Data</a>
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('account.index') }}" method="GET" class="d-flex">
                                    <select class="form-control me-2" id="listRole" name="listRole">
                                        <option value="" disabled selected>Select Role</option>
                                        <option value="0" {{ request('listRole') == 0 ? 'selected' : '' }}>User</option>
                                        <option value="1" {{ request('listRole') == 1 ? 'selected' : '' }}>Guru</option>
                                        <option value="2" {{ request('listRole') == 2 ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <form class="d-flex">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                        <table class="table table-white text-light">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    @if($selectedRole === '0')
                                        <th scope="col">Kelas</th>
                                    @endif
                                    @if($selectedRole === '1')
                                    <th scope="col">Pelajaran</th>
                                @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $selectedRole == 0 ? $account->user->name : $account->name }}</td>
                                    <td>{{ $selectedRole == 0 ? $account->user->email : $account->email }}</td>
                                    <td>{{ $selectedRole == 0 ? $account->user->role : $account->role }}</td>

                                    @if($selectedRole === '0')
                                        @if ($account->kelas)
                                            <td>{{ $account->nama_kelas }}</td>
                                        @else
                                            <td>Belum ditambahkan</td>
                                        @endif
                                    @endif
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
