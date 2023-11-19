@extends('layouts.guru')
@section('title', 'demo')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body bg-white">
                        <form action="{{route('demo.store')}}" method="post">
                            @csrf
                            <?php $questionNumber = 1; ?>
                            @foreach ($data as $isi_soal => $jawabans)
                                <p>Soal ke {{ $questionNumber++ }}</p>
                                <label name="detail_soal" value="{{ strip_tags($isi_soal) }}">{{ strip_tags($isi_soal) }}</label> <!-- This will display isi_soal with HTML tags removed -->
                                @foreach ($jawabans as $jawaban)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="detail_soal" value="{{ $jawaban }}">
                                        <label class="form-check-label" name="detail_soal" >
                                            {{ $jawaban }}
                                        </label>
                                    </div>
                                @endforeach
                            @endforeach
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
