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
                                <h5 class="mb-0">Tambah Data Cluster</h5>
                                <small class="text-muted float-end"></small>
                            </div>
                            <div class="card-body">
                                <form action="/dashboard/variable" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Data
                                            Clusters</label>
                                        <div class="col-sm-10">
                                            <select class="select2 form-select" @error('desa_id') is-invalid @enderror
                                                name="desa_id" aria-label="Default select example">
                                                <option selected disabled>Masukan Lokasi Desa </option>
                                                @foreach ($desa as $key => $value)
                                                    {
                                                    <option value="{{ $value->id_stunting }}">{{ $value->lokasi_desa }}
                                                    </option>
                                                    }
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('desa_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Berat Badan
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ old('berat') }}"
                                                name="berat"class="form-control" placeholder="Masukan Data Berat Badan" />
                                        </div>
                                        @error('berat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tinggi Badan
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ old('tinggi') }}"
                                                name="tinggi"class="form-control"
                                                placeholder="Masukan Data Tinggi badan" />
                                        </div>
                                        @error('tinggi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
