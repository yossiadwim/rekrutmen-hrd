<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/profil-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <link rel="stylesheet" href="{{ asset('css/profil-main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>


    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
    <title>Yayasan SATUNAMA</title>
</head>

<body style="font-family: Poppins">
    @include('partials.navbar')

    @auth
        @include('partials.notification_pelamar')
        <div class="container border border-light">
            <div class="row mt-3">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <p>Gagal Mengubah Profil!</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <nav class="mt-5" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/lowongan-kerja">Lowongan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                    </ol>
                </nav>
                <div class="loader-wrapper">
                    <div class="loader"></div>
                    <div class="mx-2 fw-bold text-light">Loading...</div>
                </div>

                <div class="container rounded">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-flex flex-column align-items-center  p-3 py-5">
                                <img class="mb-3" width="150px" height="150px" src="{{ asset('img/user.png') }}"
                                    style="border-radius: 50%; object-fit: cover">
                                <span> </span>

                                @include('profil.post-profile.edit-profil')

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="p-3 py-5">
                                @foreach ($pelamars as $pelamar)
                                    <h4 class="fw-bold mb-4">{{ $pelamar->nama_pelamar }}</h4>
                                    <div class="row mt-2">

                                        <div class="col-md-6">
                                            <label class="labels fw-bold"><i class="fa-solid fa-phone"></i> Nomor
                                                Telepon</label>
                                            <p>{{ $pelamar->telepon_rumah == null ? '-' : $pelamar->telepon_rumah }}</p>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="labels fw-bold"><i class="fa-solid fa-envelope"></i>
                                                Email</label>
                                            <p>{{ $pelamar->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row mt-2">

                                        @if ($pelamar->alamat == null && $pelamar->tanggal_lahir == null)
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
                                                <p>{{ $pelamar->alamat }}</p>

                                            </div>
                                            <div class="col-md-6">
                                                <label class="labels fw-bold"><i class="fa-regular fa-calendar-days"></i>
                                                    Tanggal
                                                    Lahir</label>
                                                <p>{{ \Carbon\Carbon::parse($pelamar->tanggal_lahir)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y ') }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row mt-2">
                                        @if ($pelamar->kebangsaan == null)
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
                                                <p>{{ $pelamar->kebangsaan }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="labels fw-bold"><i class="fa-solid fa-user"></i>
                                                    Jenis Kelamin</label>
                                                <p>{{ $pelamar->jenis_kelamin }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>

                <div id="loader" class="loader-wrapper" style="display: none;">
                    <div class="loader"></div>
                    <div class="mx-2 fw-bold text-light">Loading...</div>
                </div>


                <div class="container mt-4">
                    <h2 class="fw-bold">PROFIL INFORMATION</h2>
                    <div class="mb-5 mt-5"> @include('profil.post-profile.deskripsi')
                    </div>
                    <div class="mb-5 mt-5"> @include('profil.post-profile.pengalamanKerja')
                    </div>
                    <div class="mb-5 mt-5"> @include('profil.post-profile.pendidikan')
                    </div>
                    <div class="mb-5 mt-5"> @include('profil.post-profile.referensi')
                    </div>
                </div>


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
                </script>
                <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>

            </div>
        </div>
    @endauth
</body>

</html>
<script src="{{ asset('js/profil.js') }}"></script>

<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success add description'))
        toastr.success("{{ Session::get('success add description') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success add work experience'))
        toastr.success("{{ Session::get('success add work experience') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('error add work experience'))
        toastr.errors("{{ Session::get('error add work experience') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success update work experience'))
        toastr.success("{{ Session::get('success update work experience') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('error update work experience'))
        toastr.errors("{{ Session::get('error update work experience') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success delete work experience'))
        toastr.success("{{ Session::get('success delete work experience') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success add education'))
        toastr.success("{{ Session::get('success add education') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success update education'))
        toastr.success("{{ Session::get('success update education') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success delete education'))
        toastr.success("{{ Session::get('success delete education') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success add reference'))
        toastr.success("{{ Session::get('success add reference') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success update reference'))
        toastr.success("{{ Session::get('success update reference') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @elseif (Session::has('success delete reference'))
        toastr.success("{{ Session::get('success delete reference') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @endif



    function formatCurrency(input) {

        // Get input value and remove non-numeric characters
        let value = input.value.replace(/[^\d]/g, '');

        // Format the value with IDR currency format
        let formattedValue = formatIDRCurrency(value);

        // Update the input value with the formatted currency value
        input.value = formattedValue;

        // input_gaji.addEventListener("input", function() {
        //     if (input_gaji.value != "") {
        //         input_gaji.classList.add("is-valid");
        //     } else {
        //         input_gaji.classList.add("is-invalid");
        //     }
        // })

    }

    function formatIDRCurrency(value) {
        // const input_gaji = document.getElementById("gaji");
        // const feedback_validation_gaji = document.getElementById("validation-gaji");

        // // Check if value is empty or not a number
        // if (value === '' || isNaN(value)) {
        //     input_gaji.classList.add("is-invalid");
        //     feedback_validation_gaji.textContent = "Field tidak boleh kosong dan harus berupa angka";
        //     return '';
        // } else {
        //     input_gaji.classList.remove("is-invalid");
        //     input_gaji.classList.add("is-valid");

        // }

        // Convert the value to a number and apply currency formatting
        let formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });

        return formatter.format(Number(value));
    }
</script>
