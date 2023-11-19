@extends('layouts.guru')
@section('title', 'Dashboard')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <p>0</p>
                        <label>Total Siswa</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <p>0</p>
                        <label>mengikuti ujian</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <p>0</p>
                        <label>tidak mengikuti ujian</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <p>0</p>
                        <label>Dinilai</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection