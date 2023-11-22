@extends('layouts.admin')
@section('title', 'Create Account')
@section('content')
<section>
    <div class="container">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <label class="fs-4 fw-bold">Create Account</label>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('account.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option selected>Open this select menu</option>
                                    <option value="user">User</option>
                                    <option value="editor">Guru</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id">Kelas</label>
                                <select name="id" id="id" class="form-control">
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-dark mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Initially hide the "Kelas" select box
        $('#id').hide();

        // Event listener for the "Role" select box
        $('#role').change(function () {
            // Get the selected value
            var selectedRole = $(this).val();

            // Show or hide the "Kelas" select box based on the selected role
            if (selectedRole === 'user') {
                $('#id').show();
            } else {
                $('#id').hide();
            }
        });
    });
</script>

@endsection
