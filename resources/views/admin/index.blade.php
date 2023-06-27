@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-8">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Selamat datang Kembali {{ Auth::user()->name }}
                                        🎉</h5>
                                    <p class="mb-4">
                                        Terima kasih sudah login. Mari kita mulai dengan melihat informasi tentang stunting.
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-4 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .gradient {
                        background: linear-gradient(to right, #B2FEFA, #0ED2F7);
                        background-repeat: repeat;
                    }
                </style>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card gradient">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h6 class="card-title m-0 me-2">Total Kecamatan</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="avatar avatar-md border-5 border-light-primary rounded-circle mx-auto mb-4">
                                    <span class="avatar-initial rounded-circle bg-label-primary"><i
                                            class='bx bxs-map-pin'></i>
                                </div>
                                <h3 class="card-title mb-1 me-2">{{ $kecamatan }} Data Kecamatan</h3>
                                <small class="d-block mb-2">Dalam sistem kami, terdapat total {{ $kecamatan }} kecamatan
                                    yang terdata.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card gradient">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h6 class="card-title m-0 me-2">Total Stunting</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="avatar avatar-md border-5 border-light-primary rounded-circle mx-auto mb-4">
                                    <span class="avatar-initial rounded-circle bg-label-primary"><i
                                            class='bx bxs-baby-carriage'></i></span>
                                </div>
                                <h3 class="card-title mb-1 me-2">{{ $totalStunting }}</h3>
                                <small class="d-block mb-2">Dalam sistem kami, terdapat total {{ $totalStunting }} kasus
                                    stunting di seluruh kecamatan yang terdata. </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .legend {
            padding: 6px 8px;
            font: 14px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
            /*border-radius: 5px;*/
            line-height: 24px;
            color: #555;
        }

        .legend h4 {
            text-align: center;
            font-size: 16px;
            margin: 2px 12px 8px;
            color: #777;
        }

        .legend span {
            position: relative;
            bottom: 3px;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin: 0 8px 0 0;
            opacity: 0.7;
        }

        .legend i.icon {
            background-size: 18px;
            background-color: rgba(255, 255, 255, 1);
        }

        /*  */

        .kecamatan {
            padding: 6px 8px;
            font: 14px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
            /*border-radius: 5px;*/
            line-height: 24px;
            color: #555;
        }

        .kecamatan h4 {
            text-align: center;
            font-size: 16px;
            margin: 2px 12px 8px;
            color: #777;
        }

        .kecamatan span {
            position: relative;
            bottom: 3px;
        }

        .kecamatan i {
            width: 18px;
            height: 18px;
            float: left;
            margin: 0 8px 0 0;
            opacity: 0.7;
        }

        .kecamatan i.icon {
            background-size: 18px;
            background-color: rgba(255, 255, 255, 1);
        }

        .kecamatan-list {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
@endsection
