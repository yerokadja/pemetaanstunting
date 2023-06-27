<!DOCTYPE html>
<html lang="en">

<head>

    <title>{{ $title }}</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Tooplate">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/assets/user/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/user/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/user/css/animate.css">
    <link rel="stylesheet" href="/assets/user/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/user/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/user/css/tooplate-style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js "></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">
            <span class="spinner-rotate"></span>
        </div>
    </section>
    <header>
        @if (auth()->guard('pengunjung')->check() !== false)
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-5 m-4">
                        <p>Selamat Datang {{ auth()->guard('pengunjung')->user()->nama }}</p>
                    </div>

                    <div class="col-md-8 mb-5 col-sm-7 text-align-right">
                        <span class="email-icon"><i class="fa fa-user"></i> <a
                                href="#">{{ auth()->guard('pengunjung')->user()->nama }}</a></span>
                    </div>

                </div>
            </div>
        @else
        @endif
    </header>
    <!-- MENU -->
    <section class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>
                <!-- lOGO TEXT HERE -->
                <a href="index.html" class="navbar-brand">Sistem Informasi Pendataan
                    Stunting</a>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/" class="smoothScroll">Home</a></li>
                    <li><a href="/visi-misi" class="smoothScroll">Visi Misi</a></li>
                    <li><a href="/grafik" class="smoothScroll">Grafik</a></li>
                    <li><a href="/pasien" class="smoothScroll">Data Pasien</a></li>
                    @if (auth()->guard('pengunjung')->check() !== false)
                        <form id="logout-form" action="/ulogout" method="POST" style="display: none;">
                            @csrf
                            @method('POST')
                        </form>
                        <li><a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="smoothScroll">Logout</a>
                        </li>
                    @else
                        {{-- <li class="appointment-btn"><a data-toggle="modal" data-target="#exampleModalLong"
                                href="#">Login</a>
                        </li>
                        <li class="appointment-btn"><a data-toggle="modal" data-target="#register"
                                href="#">Register</a>
                        </li> --}}
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <!-- HOME -->
    <section id="home" class="slider" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="owl-carousel owl-theme">
                    <div class="item item-first">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Sayangi Anak</h3>
                                <h1>Cegah Stunting!</h1>
                            </div>
                        </div>
                    </div>

                    <div class="item item-second">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Stop Stunting,</h3>
                                <h1>Let's Grow Together!</h1>
                            </div>
                        </div>
                    </div>

                    <div class="item item-third">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Sehatkan Anak,</h3>
                                <h1>Indonesia Bebas Dari Stunting!
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @yield('content')

    <head>
        <style>
            .modal-style-1 .modal-login {
                width: 350px;
                font-size: 13px;
            }

            .modal-style-1 .modal-login .modal-header {
                border-bottom: none;
                position: relative;
                justify-content: center;
            }

            .modal-style-1 .modal-login h4 {
                color: var(--style-1-color);
                text-align: center;
                font-size: 18px;
                margin-top: 20px;
                border-bottom: 0;
                text-transform: uppercase;
                line-height: 1;
                letter-spacing: 3px;
                font-weight: 900;
                width: 100%;
            }

            .modal-style-1 .modal-header .close {
                position: absolute;
                right: 20px;
            }

            .modal-style-1 .close:focus,
            .modal-style-1 .close:active {
                outline: none !important;
                box-shadow: none;
            }

            .modal-style-1 .modal-login a {
                text-decoration: none;
            }

            .modal-style-1 .modal-login form {
                width: 280px;
                margin: 0 auto;
            }

            .modal-style-1 .modal-login span.input-group-addon {
                width: 60px;
                text-align: center;
                border-radius: 25px 0 0 25px;
                border: 1px solid var(--style-1-color);
                padding: 8px;
                margin-right: 5px;
                background: var(--style-1-color);
                color: #fff;
            }

            .modal-style-1 .modal-login span.input-group-addon i {
                font-size: 16px;
            }

            .modal-style-1 input.form-control {
                border-radius: 0 25px 25px 0;
                font-size: 13px;
                border: 1px solid var(--style-1-color);
            }

            .modal-style-1 .btn-signin {
                border-radius: 25px;
                width: 100%;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                background-color: var(--style-1-color);
                border: 1px solid var(--style-1-color);
            }

            .modal-style-1 p.hint-text {
                text-align: center;
            }

            .modal-style-1 .register {
                color: var(--style-1-color);
                font-weight: 600px;
            }

            .modal-style-1 .social-login a {
                text-decoration: none;
                color: #fff;
                margin: 2px;
                height: 30px;
                display: inline-block;
                width: 30px;
                padding: 5px 0;
                text-align: center;
                cursor: pointer;
            }

            .modal-style-1 .btn-facebook {
                background-color: var(--color-facebook);
            }

            .modal-style-1 .btn-google {
                background-color: var(--color-google);
            }

            .modal-style-1 .btn-twitter {
                background-color: var(--color-twitter);
            }

            .dark.modal-style-1 .modal-content {
                background: #7474e6;
                color: #fff;
            }

            .dark.modal-style-1 .close,
            .modal-style-1.dark .modal-login h4 {
                color: #fff;
            }

            .dark .text-danger {
                color: #777 !important;
            }

            @media only screen and (max-width: 360px) {
                .modal-style-1 .modal-login {
                    width: 100%;
                    margin: 5px;
                }

                .modal-style-1 .modal-login form {
                    width: 100%;
                }
            }
        </style>
    </head>
    <div class="row text-center mt-3">
        <div class="col-sm-4" style="display:none">
            <div class="button-card">
                <p class="text-muted"><strong class="text-danger text-uppercase">Style 1</strong> Click the button to
                    preview</p>
                <div class="action-buttons mb-3 mt-2">
                    <a href="#loginModal1" data-toggle="modal" class="btn btn-theme btn-primary text-white">
                        Login</a>
                    <a href="#registerModal1" data-toggle="modal"
                        class="btn btn-theme btn-success text-white">Register</a>
                </div>
            </div>
        </div>

        @if (session('accessing_pasien'))
            <div id="loginModal1" class="modal-style-1 dark modal ">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header p-0 mb-3 mt-3">
                            <h4 class="modal-title">login</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="/authenticate" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="login_email" name="email"
                                            value="{{ old('email') }}" placeholder="Silahkan Masukan Email...">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" class="form-control" id="login_password"
                                            name="password" placeholder="Silahkan Masukan Password...">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row pl-1 pr-1">
                                    <div class="col text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="item_checkbox"
                                                name="item_checkbox" value="option1">
                                            <span class="custom-control-label">&nbsp;Remember Me</span>
                                        </label>
                                    </div>
                                    <div class="col text-right hint-text pt-0">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-info btn-block btn-round">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="text-center mb-3">Belum Punya Akun ? <a class="register" href="#registerModal1"
                                data-dismiss="modal" data-toggle="modal">Register</a></div>
                    </div>
                </div>
            </div>
            <!-- register modal 1 -->

            <div id="registerModal1" class="modal-style-1 dark modal ">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header p-0 mb-3 mt-3">
                            <h4 class="modal-title">Register</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="/registerstore" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label" for="basic-default-name">Nama lengkap
                                    </label>
                                    <input type="text" value="{{ old('nama') }}" id="register_nama"
                                        name="nama" class="form-control" placeholder="Silahkan Masukan Nama ...">

                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label" for="basic-default-name">Tempat
                                        lahir</label>
                                    <input type="text" value="{{ old('tempat') }}" id="register_tempat"
                                        name="tempat" class="form-control" id="password1"
                                        placeholder="Silahkan Masukan Tempat Lahir...">

                                    @error('tempat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label" for="basic-default-name">Tanggal Lahir
                                    </label>
                                    <input value="{{ old('tanggal_lahir') }}" id="register_tanggal"
                                        name="tanggal_lahir" type="date" class="form-control"
                                        placeholder="Silahkan Masukan Tanggal Lahir ...">

                                    @error('tanggal_lahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label" for="basic-default-name">Email</label>
                                    <input name="email" id="email_register" value="{{ old('email') }}"
                                        type="text"class="form-control" placeholder="Silahkan Masukan Email...">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label" for="basic-default-name">Password</label>
                                    <input name="password" id="password_register" type="password"
                                        class="form-control" placeholder="Silahkan Masukan Password...">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-info btn-block btn-round">Register</button>
                            </form>
                        </div>
                        <div class="text-center mb-3">Sudah Punya Akun? <a class="register" href="#loginModal1"
                                data-dismiss="modal" data-toggle="modal">Login</a></div>
                    </div>
                </div>
            </div>
            <script src="/assets/user/js/jquery.js"></script>
            <script>
                $(document).ready(function() {
                    $('#loginModal1').modal('show');

                });
            </script>
            <script>
                $(document).ready(function() {
                    $('#loginModal1').on('hidden.bs.modal', function() {
                        // Mendapatkan token CSRF dari meta tag
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Kirim permintaan HTTP ke server untuk menghapus session
                        $.ajax({
                            url: '/hapussession',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Menyertakan token CSRF dalam header permintaan
                            },
                            success: function(response) {
                                console.log('Session dihapus');
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });
            </script>
        @endif
        <script>
            @if (session('showLoginModal'))
                $(document).ready(function() {
                    $('#loginModal1').modal('show');
                });
            @endif
        </script>
        <!-- FOOTER -->
        <footer data-stellar-background-ratio="5">
            <div class="container">
                <div class="row">

                    <div class="col-md-4 col-sm-4">
                        <div class="footer-thumb">
                            <h4 class="wow fadeInUp" data-wow-delay="0.4s">Contact Info</h4>
                            <p>Silahkan hubungi kami melalui nomor telepon atau email yang tertera untuk konsultasi
                                atau
                                informasi lebih lanjut tentang stunting.</p>
                            <div class="contact-info">
                                <p><i class="fa fa-phone"></i> 010-070-0170</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="footer-thumb">
                            <h4 class="wow fadeInUp" data-wow-delay="0.4s">Berita Terbaru</h4>
                            <div class="latest-stories">
                                <div class="stories-image">
                                    <a href="#"><img src="/assets/user/images/news-image1.jpg"
                                            class="img-responsive" alt=""></a>
                                </div>
                                <div class="stories-info">
                                    <a href="#">
                                        <h5>5 Cara Cegah Stunting pada Anak</h5>
                                    </a>
                                    <span>March 08, 2018</span>
                                </div>
                            </div>

                            <div class="latest-stories">
                                <div class="stories-image">
                                    <a href="/berita-detail"><img src="/assets/user/images/news-image1.jpg"
                                            class="img-responsive" alt=""></a>
                                </div>
                                <div class="stories-info">
                                    <a href="/berita-detail">
                                        <h5>5 Cara Cegah Stunting pada Anak</h5>
                                    </a>
                                    <span>February 20, 2018</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="footer-thumb">
                            <ul class="social-icon">
                                <li><a href="https://www.facebook.com/tooplate" class="fa fa-facebook-square"
                                        attr="facebook icon"></a></li>
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 border-top">
                        <div class="col-md-4 col-sm-6">
                            <div class="copyright-text">
                                <p>Copyright &copy; 2023 Stefania Roslinda Daiman

                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 text-align-center">
                            <div class="angle-up-btn">
                                <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i
                                        class="fa fa-angle-up"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        @if ($message = Session::get('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ $message }}',
                });
            </script>
        @endif

        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Success',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            </script>
        @endif

        <!-- SCRIPTS -->
        <script src="/assets/user/js/jquery.js"></script>
        <script src="/assets/user/js/bootstrap.min.js"></script>
        <script src="/assets/user/js/jquery.sticky.js"></script>
        <script src="/assets/user/js/jquery.stellar.min.js"></script>
        <script src="/assets/user/js/wow.min.js"></script>
        <script src="/assets/user/js/smoothscroll.js"></script>
        <script src="/assets/user/js/owl.carousel.min.js"></script>
        <script src="/assets/user/js/custom.js"></script>
        <script>
            $(document).ready(function() {
                @if ($errors->has('email') || $errors->has('password'))
                    $('#exampleModalLong').modal('show');
                @endif
            });

            $(document).ready(function() {
                @if (
                    $errors->has('nama') ||
                        $errors->has('tanggal_lahir') ||
                        $errors->has('tempat') ||
                        $errors->has('email1') ||
                        $errors->has('password1'))
                    $('#register').modal('show');
                @endif
            });
        </script>
    </div>
</body>

</html>
