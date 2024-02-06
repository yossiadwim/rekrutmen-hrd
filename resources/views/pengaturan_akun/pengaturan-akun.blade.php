<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>

</head>

<body style="font-family: Poppins;">

    @include('partials.navbar')
    @auth
        @include('partials.notification_pelamar')
        @if ($errors->any())
            <div class="container justify-content-center col-8 mt-2">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="container">
            <nav class="mt-5 mb-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/lowongan-kerja">Lowongan Kerja</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengaturan Akun</li>
                </ol>
            </nav>
        </div>
    @endauth



    <div class="container mb-5">
        <h3 class="fw-bold">Pengaturan Akun</h3>
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="d-flex flex-column align-items-center p-3 py-5">
                    <img class="rounded-circle " width="150px"
                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span> </span>

                    <a class="btn btn-success" href="/profil-kandidat/users/{{ $user->uuid }}" role="button">Edit
                        Profil</a>

                </div>

            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">

                    <h4 class="fw-bold mb-4">{{ $user->pelamar->nama_pelamar }}</h4>
                    <div class="row mt-2">
                        @if ($user->pelamar->telepon_rumah == null)
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-phone"></i> Nomor
                                    Telepon</label>
                                <p>{{ '-' }}</p>
                            </div>
                        @else
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-phone"></i> Nomor
                                    Telepon</label>
                                <p>{{ $user->pelamar->telepon_rumah }}</p>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label class="labels fw-bold"><i class="fa-solid fa-envelope"></i>
                                Email</label>
                            <p>{{ $user->pelamar->email }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        @if ($user->pelamar->alamat == null && $user->pelamar->tanggal_lahir == null)
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-location-dot"></i>
                                    Alamat</label>
                                <p>{{ '-' }}</p>

                            </div>
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-regular fa-calendar-days"></i>
                                    Tanggal
                                    Lahir</label>
                                <p>{{ '-' }}</p>
                            </div>
                        @else
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-location-dot"></i>
                                    Alamat</label>
                                <p>{{ $user->pelamar->alamat }}</p>

                            </div>
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-regular fa-calendar-days"></i>
                                    Tanggal
                                    Lahir</label>
                                <p>{{ \Carbon\Carbon::parse($user->pelamar->tanggal_lahir)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y ') }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="row mt-2">
                        @if ($user->pelamar->kebangsaan == null)
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-globe"></i>
                                    Kebangsaan</label>
                                <p>{{ '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-user"></i>
                                    Jenis Kelamin</label>
                                <p>{{ '-' }}</p>
                            </div>
                        @else
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-globe"></i>
                                    Kebangsaan</label>
                                <p>{{ $user->pelamar->kebangsaan }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-user"></i>
                                    Jenis Kelamin</label>
                                <p>{{ $user->pelamar->jenis_kelamin }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="container border-top">
            <div class="d-flex align-items-star mt-4 mx-5 px-5">
                <div class="border-3 border-end">
                    <div class="nav flex-column  nav-pills me-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link mb-2  text-start active" id="v-pills-akun-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-akun" type="button" role="tab" aria-controls="v-pills-akun"
                            aria-selected="true">Akun</button>
                        <button class="nav-link mb-2 text-start" id="v-pills-kontak-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-kontak" type="button" role="tab"
                            aria-controls="v-pills-kontak" aria-selected="false">Kontak</button>

                        <button class="nav-link mb-2 text-start" id="v-pills-bantuan-dukungan-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-bantuan-dukungan" type="button"
                            role="tab" aria-controls="v-pills-bantuan-dukungan" aria-selected="false">Bantuan &
                            Dukungan</button>
                    </div>
                </div>

                <div class="container">
                    <div class="tab-content" id="v-pills-tabContent">
                        @include('pengaturan_akun.akun')
                        @include('pengaturan_akun.kontak')
                        {{-- @include('pengaturan_akun.bantuan_dukungan') --}}
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>

<script src="{{ asset('js/pengaturan-akun.js') }}"></script>

<script>
    @if (Session::has('success change password'))
        toastr.success("{{ Session::get('success change password') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('failed change password'))
        toastr.error("{{ Session::get('failed change password') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success change email'))
        toastr.success("{{ Session::get('success change email') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('failed change email'))
        toastr.error("{{ Session::get('failed change email') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success change phone number'))
        toastr.success("{{ Session::get('success change phone number') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('failed change phone number'))
        toastr.error("{{ Session::get('failed change phone number') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @endif

    function validatePasswordConfirmation() {
        const password_baru = document.getElementById("password_baru");
        const konfirmasi_password_baru = document.getElementById("konfirmasi_password_baru");

        if (password_baru.value !== konfirmasi_password_baru.value) {
            konfirmasi_password_baru.classList.add("invalid");
        } else {
            konfirmasi_password_baru.classList.remove("invalid");
        }
    }

    function togglePasswordVisibility() {
        const password_baru = document.getElementById("password_baru");
        const konfirmasi_password_baru = document.getElementById("konfirmasi_password_baru");
        const showPasswordBaru = document.getElementById("showpasswordbaru");
        const showKonfirmasiPasswordBaru = document.getElementById("showkonfirmasipasswordbaru");

        if (password_baru.type === "password") {
            password_baru.type = "text";
            showPasswordBaru.textContent = "Sembunyikan Kata Sandi";
        } else {
            password_baru.type = "password";
            showPasswordBaru.textContent = "Tampilkan Kata Sandi";
        }

        if (konfirmasi_password_baru.type === "password") {
            konfirmasi_password_baru.type = "text";
            showKonfirmasiPasswordBaru.textContent = "Sembunyikan Kata Sandi";
        } else {
            konfirmasi_password_baru.type = "password";
            showKonfirmasiPasswordBaru.textContent = "Tampilkan Kata Sandi";
        }
    }
</script>
