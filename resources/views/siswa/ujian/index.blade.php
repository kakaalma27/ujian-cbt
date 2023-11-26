@extends('layouts.app')
@section('title', 'Ujian')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-white" style="border: none; box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;">
               <div class="card-header bg-dark text-center">
                <label class="fs-4 fw-normal fw-bold text-light">Informasi Ujian</label>
               </div>
                <div class="card-body">
                    @php $kelasTerpilih = null @endphp

                    @foreach ($infoUjian as $info)
                        @if ($info->kelas && $info->kelas->id == $info->kelas_id && $info->kelas->id != $kelasTerpilih)
                            <div class="mb-3">
                                <label>Kelas : {{ $info->kelas->nama_kelas }}</label>
                            </div>
                            @php $kelasTerpilih = $info->kelas->id @endphp
                        @endif
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
        <form action="{{route('siswa.ujian')}}" method="POST">
            @csrf
                <div class="card bg-white border-0" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;">
                    @foreach ($soal as $index => $soals)
                        <div class="card-header border-0 bg-dark">
                            <label class="fs-4 fw-nromal text-light">Soal No: {{ $index + 1 }}</label>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <p class="card-text fs-5 fw-bold">{{ $soals->isi_soal }}</p>
                                @foreach ($soals->jawabans as $jawaban)

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label fs-5" for="flexRadioDefault1">
                                        {{ $jawaban->isi_jawaban }}                                
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mb-2">
                    @if ($soal->hasMorePages())
                        <a href="{{ $soal->nextPageUrl() }}" class="btn btn-primary">Next</a>
                    @endif
                </div>
        </form>
        </div>
    </div>
</div>

@endsection
