@extends('user.layouts.layouts')
@section('content')

    <head>
        <style>
            h2 {
                color: #03396c;
                font-size: 32px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
            }

            p {
                font-size: 20px;
                line-height: 1.5;
                text-align: justify;
            }

            ol {
                font-size: 20px;
                line-height: 1.5;
                padding-left: 30px;
            }

            li {
                margin-bottom: 5px;
            }
        </style>
    </head>
    <section id="news" data-stellar-background-ratio="2.5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>VISI MISI</h2>
                    </div>
                </div>
            </div>
            <section>
                <h2>Visi</h2>
                {!! $visimisi->visi !!}

            </section>
            <section>
                <h2>Misi</h2>
                {!! $visimisi->misi !!}
            </section>
    </section>
@endsection
