@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Pengaturan Settings /</span> Keamanan
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item"><a class="nav-link" href="/dashboard/profile-setting"><i
                                    class="bx bx-user me-1"></i> Account</a></li>
                        <li class="nav-item"><a class="nav-link active" href="/dashboard/password-setting"><i
                                    class="bx bx-lock-alt me-1"></i> Security</a></li>
                    </ul>
                    <!-- Change Password -->
                    <div class="card mb-4">
                        <h5 class="card-header">Ganti Password</h5>
                        <div class="card-body">
                            <form action="/dashboard/password-setting/" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="currentPassword">Password Lama</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" value="{{ old('currentPassword') }}" type="password"
                                                name="currentPassword" id="currentPassword"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                        @error('currentPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="newPassword">Password Baru</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" id="newPassword" name="newPassword"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                        @error('newPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-1">
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        <button type="reset" class="btn btn-success">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
