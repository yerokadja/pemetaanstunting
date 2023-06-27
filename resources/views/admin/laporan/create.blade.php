@extends('layouts.master')
@section('content')
<div class="content-wrapper"> 
  @if($errors->any())
  {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
  <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Data</h5>
        <small class="text-muted float-end"></small>
      </div>
      <div class="card-body">
        <form action="/laporan/store" method="post">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Bulan</label>
            <div class="col-sm-10">
              <input type="text" name="bulan"class="form-control" id="bulan" placeholder="Bulan" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Tahun</label>
            <div class="col-sm-10">
              <input type="text" name="tahun" class="form-control" id="tahun" placeholder="Tahun" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Jumlah Pasien</label>
            <div class="col-sm-10">
              <input type="text" name="jumlah_pasien" class="form-control" id="jumlah_pasien" placeholder="Jumlah Pasien" />
            </div>
          </div>
                
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Send</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
  @endsection`