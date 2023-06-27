@extends('layouts.master')
@section('content')
<div class="content-wrapper"> 
  
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic with Icons -->
    <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Edit Data </h5>
             
              <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
              <form action="/laporan/update/{{ $laporan->id }}" method="post">
                @csrf
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-name">Bulan</label>
                  <div class="col-sm-10">
                    <input required type="text" value="{{ old('bulan') ?? $laporan->bulan }}" name="bulan" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-name">Tahun</label>
                  <div class="col-sm-10">
                    <input required type="text" value="{{ old('bulan') ?? $laporan->tahun }}" name="tahun" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-name">Jumlah Pasien</label>
                  <div class="col-sm-10">
                    <input required type="text" value="{{ old('jumlah_pasien') ?? $laporan->jumlah_pasien }}" name="jumlah_pasien" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                  </div>
                </div>
            <button type="submit" class="btn btn-primary">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
  @endsection