@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        {{-- @if ($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif --}}
        {{-- @if (isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Edit Data Kecamatan</h5>
                                <small class="text-muted float-end"></small>
                            </div>
                            <div class="card-body">
                                <form action="/dashboard/kecamatan/{{ $kecamatan->id_kecamatan }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Kode
                                            Kecamatan</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                value="{{ old('kode_kecamatan') ?? $kecamatan->kode_kecamatan }}"
                                                name="kode_kecamatan"class="form-control"
                                                placeholder="Masukan Kode Kecamatan" />
                                        </div>
                                        @error('kode_kecamatan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama
                                            Kecamatan</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                value="{{ old('kecamatan') ?? $kecamatan->nama_kecamatan }}"
                                                name="kecamatan"class="form-control" placeholder="Masukan Nama Kecamatan" />
                                        </div>
                                        @error('kecamatan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Warna</label>
                                        <div class="col-sm-10">
                                            <input type="color" name="warna"
                                                value="{{ old('warna') ?? $kecamatan->warna }}" class="form-control" />
                                        </div>
                                        @error('warna')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Upload File Geojson
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="file"
                                                value="{{ old('file_geo_json') ?? $kecamatan->file_geo_json }}"
                                                name="file_geo_json" class="form-control">
                                            @if ($kecamatan->file_geo_json)
                                                <div class="mt-2">File saat ini: {{ $kecamatan->file_geo_json }}</div>
                                            @endif
                                        </div>
                                        @error('file_geo_json')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection`
