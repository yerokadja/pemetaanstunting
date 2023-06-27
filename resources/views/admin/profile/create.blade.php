@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        @if ($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Tambah Data Visi & Misi</h5>
                                <small class="text-muted float-end"></small>
                            </div>
                            <div class="card-body">
                                <form action="/dashboard/profil" method="POST">
                                    @csrf

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Visi</label>
                                        <div class="col-sm-9">
                                            <textarea name="visi" id="sdeskripsi" cols="23" rows="5">{{ old('deskripsi') }}</textarea>
                                        </div>
                                        @error('deskripsi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Misi</label>
                                        <div class="col-sm-9">
                                            <textarea name="misi" id="deskripsi" cols="23" rows="5">{{ old('deskripsi') }}</textarea>
                                        </div>
                                        @error('deskripsi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row justify-content-center">
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
        <script>
            CKEDITOR.replace('sdeskripsi');
        </script>
        <script>
            CKEDITOR.replace('deskripsi');
        </script>
    @endsection
