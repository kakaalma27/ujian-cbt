@extends('layouts.guru')
@section('title', 'buat')
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
            <form action="{{route('guru.upload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="card" style="border: none; box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;">
                        <div class="card-header bg-dark text-light">
                            <h3>Ujian pilihan Ganda</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="pelajaran_id" id="pelajaran_id" name="pelajaran_id" class="form-control bg-white">
                                        <option selected>Pilih Pelajaran</option>

                                        @foreach ($pelajarans as $pelajaran)
                                        <option value="{{ $pelajaran->id }}">{{ $pelajaran->pelajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="kelas_id" id="kelas_id" class="form-control bg-white">
                                        <option selected>pilih kelas</option>

                                        @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <input type="time" class="form-control bg-white" name="jam_menit" id="exampleNumber" placeholder="Menit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="card" style="border: none; box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;">
                        <div class="card-header bg-dark text-light" >
                            <h3>Soal Ujian</h3>
                        </div>
                        <div class="card-body" id="add_soal">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" name="data[isi_soal][]" id="editor"></textarea>
                                        </div>      
                                    </div>                                
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="data[isi_jawaban][]" class="form-control bg-white" placeholder="Pilihan A">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="data[isi_jawaban][]" class="form-control bg-white" placeholder="Pilihan B">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="data[isi_jawaban][]" class="form-control bg-white" placeholder="Pilihan C">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="data[isi_jawaban][]" class="form-control bg-white" placeholder="Pilihan D">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="data[isi_jawaban][]" class="form-control bg-white" placeholder="Pilihan E">
                                    </div>
                                </div>
                            </div>
                            <select class="form-select bg-white" name="data[isi_jawaban_correct]" aria-label="Default select example">
                                <option selected>Pilih Jawaban</option>
                                <option value="0">A</option>
                                <option value="1">B</option>
                                <option value="2">C</option>
                                <option value="3">D</option>
                                <option value="4">E</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" id="addSoalButton" class="btn btn-primary">add Soal</button>
            </form>
        </div>
    </div>
</section>
@endsection
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            });
    }); // Tambahkan kurung kurawal dan tanda kurung tutup yang hilang
</script>
