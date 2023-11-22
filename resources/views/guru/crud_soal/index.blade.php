@extends('layouts.guru')
@section('title', 'Dashboard')
@section('content')
<section>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <h1>List Ujian</h1>
            </div>
            <div class="card-body">
                <a href="{{ route('guru.create') }}" class="btn btn-dark">Tambah soal</a>
                <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload soal</a>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Pelajaran</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>Ujian</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="uploadModalLabel">Upload Soal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="{{route('guru.uploadExcal')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                  <div class="card-header bg-dark text-light">
                      <h3>Ujian pilihan Ganda</h3>
                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-4">
                              <select name="pelajaran_id" id="pelajaran_id" name="data[isi_soal][]" class="form-control">
                                  <option selected>Pilih Pelajaran</option>

                                  @foreach ($pelajarans as $pelajaran)
                                  <option value="{{ $pelajaran->id }}">{{ $pelajaran->pelajaran }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-4">
                              <select name="kelas_id" id="kelas_id" class="form-control">
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
              <div class="mb-3">
                <input class="form-control bg-whte" type="file" name="xlsx_file" id="formFile">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection