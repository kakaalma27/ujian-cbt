@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-white" style="border: none;">
                <div class="card-body">
                    @foreach ($infoUjian as $info)
                        <div class="mb-3">
                            <label>Kelas : {{ $info->nama_kelas }}</label>
                        </div>
                    @endforeach
                    @foreach ($cek as $pelajaran)                        
                        <div class="mb-3">
                            <label>Pelajaran : {{ $pelajaran->pelajaran }}</label>
                        </div>
                    @endforeach
                    <div class="mb-3">
                        <label>Jumlah Soal : {{ $infoSoal }}</label>
                    </div>
                    
                        <div class="mb-3">
                            <label>Waktu Ujian : </label>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card bg-white border-0">
                @foreach ($soal as $index => $soals)
                    <div class="card-header bg-white border-0">
                        <h5 class="card-title">Soal No: {{ $index + 1 }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <p class="card-text">{{ $soals->isi_soal }}</p>
                            @foreach ($soals->jawabans as $jawaban)

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{ $jawaban->isi_jawaban }}                                
                                </label>
                              </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
        
                <div class="mt-2">
                    {{ $soal->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
