{{-- @dd($lowongan) --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yayasan SATUNAMA</title>
    <link rel="icon" type="image/png" href="/img/satunama-logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin-kelola-lowongan-style.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>

</head>

<body>
    @include('partials.navbar')

    @auth
        @include('partials.notification_admin')
    @endauth

    @if (session()->has('success add schedule'))
        <div class="container justify-content-center col-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center">
                {{ session('success add schedule') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @elseif (session()->has('success edit schedule'))
        <div class="container justify-content-center col-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center">
                {{ session('success edit schedule') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @elseif (session()->has('success change position'))
        <div class="container justify-content-center col-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center">
                {{ session('success change position') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (count($datas) == 0)
        <div class="container justify-content-center col-8 mt-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center">
                <h3>Belum ada pelamar yang mendaftar</h3>
                <a href="/admin-dashboard/lowongan" class="btn btn-secondary mt-4" role="button">Kembali ke halaman
                    sebelumnya</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @else
        {{-- @if ($lowongan->closed != true) --}}
        <div class="container mt-4 ">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin-dashboard/lowongan">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelola Pelamar</li>
                </ol>
            </nav>

            <h3 class="fw-bold">{{ $lowongan->nama_lowongan }} </h3>
            <span class="badge rounded-pill text-bg-success mb-2">Aktif</span>
            <h6>{{ $lowongan->tipe_lowongan }}</h6>
            <h6>Dibuat pada:
                {{ \Carbon\Carbon::parse($lowongan->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y ') }}
                | Diedit pada:
                {{ \Carbon\Carbon::parse($lowongan->updated_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y ') }}
            </h6>
        </div>

        <div class="container rounded mt-4 fw-bold shadow-sm bg-body-tertiary rounded"
            style="background-color: #eaeaea">
            <ul class="nav nav-pills nav- mb-3 py-2 px-2 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active btn " id="pills-review-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-review" type="button" role="tab" aria-controls="pills-review"
                        aria-selected="true">Review
                        @if ($review == null)
                            <span class="badge text-bg-secondary">0</span>
                        @else
                            <span class="badge text-bg-secondary">{{ count($review) }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-seleksi-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-seleksi-berkas" type="button" role="tab"
                        aria-controls="pills-seleksi" aria-selected="false">Seleksi Berkas
                        @if ($seleksi_berkas == null)
                            <span class="badge text-bg-secondary">0</span>
                        @else
                            <span class="badge text-bg-secondary">{{ count($seleksi_berkas) }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link " id="pills-reference-check-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-reference-check" type="button" role="tab"
                        aria-controls="pills-reference-check" aria-selected="false">Reference Check
                        @if ($reference_check == null)
                            <span class="badge text-bg-secondary">0</span>
                        @else
                            <span class="badge text-bg-secondary">{{ count($reference_check) }}</span>
                        @endif

                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-tes-tab" data-bs-toggle="pill" data-bs-target="#pills-tes"
                        type="button" role="tab" aria-controls="pills-tes" aria-selected="false">Tes
                        @if ($tes == null)
                            <span class="badge text-bg-secondary">0</span>
                        @else
                            <span class="badge text-bg-secondary">{{ count($tes) }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-penawaran-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-penawaran" type="button" role="tab"
                        aria-controls="pills-penawaran" aria-selected="false">Penawaran
                        @if ($penawaran == null)
                            <span class="badge text-bg-secondary">0</span>
                        @else
                            <span class="badge text-bg-secondary">{{ count($penawaran) }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-direkrut-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-direkrut" type="button" role="tab"
                        aria-controls="pills-direkrut" aria-selected="false">Direkrut

                        @if ($direkrut == null)
                            <span class="badge text-bg-secondary">0</span>
                        @else
                            <span class="badge text-bg-secondary">{{ count($direkrut) }}</span>
                        @endif

                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-ditolak-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-ditolak" type="button" role="tab" aria-controls="pills-ditolak"
                        aria-selected="false">Ditolak
                        @if ($ditolak == null)
                            <span class="badge text-bg-secondary">0</span>
                        @else
                            <span class="badge text-bg-secondary">{{ count($ditolak) }}</span>
                        @endif

                    </button>


                </li>
            </ul>
        </div>


        <div class="tab-content" id="pills-tabContent">
            @include('dashboard.kelola_kandidat.review_kandidat')
            @include('dashboard.kelola_kandidat.seleksi_berkas_kandidat')
            @include('dashboard.kelola_kandidat.reference_check_kandidat')
            @include('dashboard.kelola_kandidat.penawaran_kandidat')
            @include('dashboard.kelola_kandidat.assesment_kandidat')
            @include('dashboard.kelola_kandidat.direkrut_kandidat')
            @include('dashboard.kelola_kandidat.ditolak_kandidat')

        </div>

    @endif

    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="mx-2 fw-bold text-light">Loading...</div>
    </div>
    <div id="loader" class="loader-wrapper" style="display: none;">
        <div class="loader"></div>
        <div class="mx-2 fw-bold text-light">Loading...</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

</body>

</html>
<script>
    window.addEventListener("load", function() {
        const loader = document.querySelector(".loader-wrapper");
        const content = document.querySelector(".content");

        // Hide the loader
        loader.style.display = "none";

    });




    function hapusData() {
        document.getElementById("formAddScheduleTest").reset();
    }

    function getData(id) {

        // var button_status = document.getElementById('button_status-' + id);
        // var value_button_status = button_status.getAttribute('value');

        // var id_status_review_page = document.getElementById('id_status_review_page-' + id)
        // id_status_review_page.value = value_button_status;

        var button_status_seleksi = document.getElementById('button_status_seleksi-' + id);
        var value_button_status_seleksi = button_status_seleksi.getAttribute('value');

        var id_status_seleksi_page = document.getElementById('id_status_seleksi_page-' + id)
        id_status_seleksi_page.value = value_button_status_seleksi;

    }


    document.addEventListener('DOMContentLoaded', function() {
        // Replace 'your_id_here' with the dynamic ID you want to use
        const detail = document.getElementsByClassName("btn-detail");
        console.log(detail);

        for (let index = 0; index < detail.length; index++) {
            const edit = detail[index].getAttribute('data-pk-id');
            getID(edit);
        }

    });

    function getID(id) {
        // Use the 'id' parameter to create the dynamic button ID
        var button = document.getElementById('button-detail-' + id);

        if (button) {
            button.addEventListener('click', function() {
                const loader = document.getElementById('loader');

                // Display the loader
                loader.style.display = 'flex';

                // Simulate a form submission delay (replace with your actual form submission logic)
                setTimeout(function() {
                    // Hide the loader when the form submission is complete
                    loader.style.display = 'none';


                }, 2500);
            });
        }

    }
</script>
