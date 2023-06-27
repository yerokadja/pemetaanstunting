@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Profil Setting /</span> Profil
            </h4>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item"><a class="nav-link active" href="/dashboard/profil/setting"><i
                                    class="bx bx-user me-1"></i> Account</a></li>
                        <li class="nav-item"><a class="nav-link" href="/dashboard/password-setting"><i
                                    class="bx bx-lock-alt me-1"></i> Security</a></li>
                    </ul>
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="/assets/img/avatars/7.png" alt="user-avatar" class="d-block rounded"
                                    height="100" width="100" id="uploadedAvatar" />
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <form action="/dashboard/profile-setting/{{ $data->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Nama</label>
                                        <input class="form-control" type="text" id="nama" name="nama"
                                            value="{{ $data->name }}" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="text" name="email" id="email"
                                            value="{{ $data->email }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Username</label>
                                        <input class="form-control" type="text" id="username" name="username"
                                            value="{{ $data->username }}" />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
