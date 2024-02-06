<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SATUNAMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin-dashboard.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/instrumen_analisa.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>
</head>

<body style="font-family: Poppins">

    @auth
        @include('partials.navbar')

        @include('partials.notification_admin')

        <div class="shadow-sm p-3 mb-1 bg-body-tertiary rounded">
            <div class="container">
                <nav class="mt-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="/admin-dashboard/lowongan/{{ $lowongan->slug }}/detail-pelamar/{{ $data_pelamar->uuid }}">Detail
                                Kandidat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Analisa Bobot Beban Kerja</li>
                    </ol>
                </nav>
                <h4 class="mt-5 text-center fw-bold">{{ $lowongan->nama_lowongan }}</h4>
                <h6 class="mt-2 text-center fw-bold">Departemen {{ $lowongan->departemen->nama_departemen }}</h6>

                <div class="text-center">

                    <p id="nama_pelamar">Nama pelamar: {{ $data_pelamar->pelamar->nama_pelamar }}</p>

                </div>
            </div>

        </div>

        <div class="" style="background-color: rgb(247, 247, 247)">
            <div class="container">

                <div class="row">
                    <div class="col-4 mt-4 mb-5">
                        <h3 class="fw-bold text-center">INSTRUMEN ANALISA</h3>
                    </div>
                    <div class="col-4 mt-4 text-center">

                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success"
                                style="width: {{ (count($hasil_analisa_exists) / count($tipe_analisa)) * 100 }}%"></div>
                        </div>
                        <h6>{{ count($hasil_analisa_exists) }}/{{ count($tipe_analisa) }} terisi</h6>

                    </div>
                    <div class="col-4 mt-4 mb-5">
                        <h4 class="fw-bold text-end">Poin: <span
                                class="badge text-bg-success">{{ $total_poin[0]->total_poin == null ? '0' : $total_poin[0]->total_poin }}
                            </span></h4>
                    </div>
                </div>

                <div class="row gx-0 gy-0">
                    @if ($data_hasil_analisa_exists)
                        @foreach ($tipe_analisa as $data)
                            <div class="col-4">
                                <div class="card mb-5 mx-5 border border-1 shadow-sm bg-body-tertiary rounded"
                                    style="height: 15rem; width: 25rem">
                                    @if ($hasil_analisa_exists->contains('id_tipe_analisa', $data->id_tipe_analisa))
                                        <div class="card-body">
                                            @foreach ($data_hasil_analisa as $index => $data_analisa)
                                                @if ($data_analisa->jenisAnalisa->tipeAnalisa->id_tipe_analisa == $data->id_tipe_analisa)
                                                    <div class="">
                                                        <p class="" style="color: rgb(105, 105, 105)">
                                                            {{ $data_analisa->jenisAnalisa->tipeAnalisa->id_tipe_analisa }}.
                                                            {{ Str::title($data_analisa->jenisAnalisa->tipeAnalisa->nama_analisa) }}
                                                        </p>
                                                        <p class="fw-bold">
                                                            {{ $data_analisa->jenisAnalisa->jenisAnalisaKriteria[0]->jenis_analisa_kriteria }}

                                                        </p>
                                                        <label class="labels fw-bold">
                                                            Poin</label>
                                                        <p>{{ $data_analisa->poin }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#jenis_kriteria_{{ $data_analisa->id_jenis_analisa }}">
                                                                Detail
                                                                <i class="fa-solid fa-circle-info"
                                                                    style="color: #ffffff;"></i>
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="jenis_kriteria_{{ $data_analisa->id_jenis_analisa }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="exampleModalLabel">
                                                                                Detail</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Tipe analisa:
                                                                                {{ Str::title($data_analisa->jenisAnalisa->tipeAnalisa->nama_analisa) }}
                                                                            </p>
                                                                            <p>Jenis analisa kriteria:
                                                                                {{ $data_analisa->jenis_analisa_kriteria }}
                                                                            </p>
                                                                            <label>Kriteria:</label>
                                                                            <p style="text-align: justify">
                                                                                {!! str_replace('\n', '<br> <br>', nl2br($data_analisa->jenisAnalisa->jenisAnalisaKriteria[0]->kriteria)) !!}
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Keluar</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <button type="button" class="btn text-light btn-warning"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#instrumen-{{ $data->slug }}">
                                                                Edit
                                                                <i class="fa-solid fa-pen-to-square"
                                                                    style="color: #ffffff;"></i>
                                                            </button>
                                                        </div>

                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="card-body d-flex justify-content align-items-center">
                                            <div class="col text-center">
                                                <p class="text-center">{{ Str::title($data->nama_analisa) }}</p>
                                                <button type="button"
                                                    class="btn border border-1 btn-primary btn-instrumen "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#instrumen-{{ $data->slug }}">
                                                    <div class="text-center">
                                                        <i class="fa-solid fa-circle-plus"></i>
                                                        Tambahkan Analisa
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($tipe_analisa as $data)
                            <div class="col-4">
                                <div class="card mb-5 mx-5 border border-0 shadow-sm bg-body-tertiary rounded"
                                    style="height: 15rem; width: 25rem">
                                    <div class="card-body d-flex justify-content align-items-center">
                                        <div class="col text-center">
                                            <p class="text-center">{{ Str::title($data->nama_analisa) }}</p>
                                            <button type="button" class="btn border border-1 btn-primary btn-instrumen "
                                                data-bs-toggle="modal" data-bs-target="#instrumen-{{ $data->slug }}">
                                                <div class="text-center">
                                                    <i class="fa-solid fa-circle-plus"></i>
                                                    Tambahkan Analisa
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @include('dashboard.instrumen_analisa.instrumen_pendidikan')
                    @include('dashboard.instrumen_analisa.instrumen_pengalaman')
                    @include('dashboard.instrumen_analisa.instrumen_keterampilan_hubungan')
                    @include('dashboard.instrumen_analisa.instrumen_manajemen')
                    @include('dashboard.instrumen_analisa.instrumen_tantangan_berpikir')
                    @include('dashboard.instrumen_analisa.instrumen_lingkungan_berpikir')
                    @include('dashboard.instrumen_analisa.instrumen_tingkatan_kebebasan_bertindak')
                    @include('dashboard.instrumen_analisa.instrumen_sikap_dan_besaran_dampak')
                    @include('dashboard.instrumen_analisa.instrumen_signifikansi_area_dampak')
                </div>
            </div>
        </div>

    @endauth

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
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <script src="{{ asset('js/instrumen-analisa-beban-kerja-pendidikan.js') }}"></script>
    <script src="{{ asset('js/instrumen-analisa-beban-kerja-pengalaman.js') }}"></script>
    <script src="{{ asset('js/instrumen-analisa-beban-kerja-keterampilan-hubungan.js') }}"></script>
    <script src="{{ asset('js/instrumen-analisa-beban-kerja-manajemen.js') }}"></script>
    <script src="{{ asset('js/instrumen-analisa-beban-kerja-tantangan-berpikir.js') }}"></script>
    <script src="{{ asset('js/instrumen-analisa-beban-kerja-lingkungan-berpikir.js') }}"></script>
    <script src="{{ asset('js/instrumen-analisa-beban-kerja-tingkatan-kebebasan-bertindak.js') }}"></script>
    <script src="{{ asset('js/instrumen-analisa-beban-kerja-sikap-dan-besaran-dampak.js') }}"></script>
    <script src="{{ asset('js/instrumen-analisa-beban-kerja-signifikansi-area-dampak.js') }}"></script>
</body>

</html>

<script>
    @if (Session::has('success add education analysis'))
        toastr.success("{{ Session::get('success add education analysis') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @endif

    window.addEventListener("load", function() {
        const loader = document.querySelector(".loader-wrapper");
        const content = document.querySelector(".content");

        // Hide the loader
        loader.style.display = "none";

    });

    document.addEventListener('DOMContentLoaded', function() {
        // Replace 'your_id_here' with the dynamic ID you want to use
        const button_analisa = document.getElementsByClassName("btn-simpan-analisa");

        for (let index = 0; index < button_analisa.length; index++) {
            const analisa = button_analisa[index].value;
            getID(analisa);
        }

    });

    function getID(id) {
        // Use the 'id' parameter to create the dynamic button ID
        var button = document.getElementById('simpan-analisa-' + id);

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

    var slider = document.getElementById("rangeSlider");
    var output = document.getElementById("sliderValue");

    // Display the initial value
    output.innerHTML = slider.value;

    // Update the value display when the slider is moved
    slider.oninput = function() {
        output.innerHTML = this.value;
    };
</script>
