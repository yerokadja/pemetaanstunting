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
                                <h5 class="mb-0">Pendataan Stunting</h5>
                                <small class="text-muted float-end"></small>
                            </div>
                            <div class="card-body">
                                <form action="/dashboard/stunting" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Kecamatan
                                        </label>
                                        <div class="col-sm-10">
                                            <select class="select2 form-select" @error('id_kecamatan') is-invalid @enderror
                                                name="id_kecamatan" aria-label="Default select example">
                                                <option selected disabled>Masukan Kecamatan </option>
                                                @foreach ($kecamatan as $key => $value)
                                                    {
                                                    <option value="{{ $value->id_kecamatan }}">{{ $value->nama_kecamatan }}
                                                    </option>
                                                    }
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('id_kecamatan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Jumlah
                                            Stunting</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ old('jumlah_stunting') }}"
                                                name="jumlah_stunting"class="form-control"
                                                placeholder="Masukan Jumlah Stunting" />
                                        </div>
                                        @error('jumlah_stunting')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-name">Usia
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ old('usia') }}"
                                                name="usia"class="form-control" placeholder="Masukan Usia" />
                                        </div>
                                        @error('usia')
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
                                            <button type="submit" class="btn btn-primary">Send</button>
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
