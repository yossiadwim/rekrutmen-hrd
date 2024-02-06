{{-- @dd($datas) --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>

</head>

<body style="font-family: Poppins;">

    @auth
        @include('partials.navbar')

        @include('partials.notification_admin')

        @if (session()->has('failed send application form'))
            <div class="container justify-content-center col-8">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center">
                    {{ session('failed send application form') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif


        <div class="container mt-5 mb-3">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="/admin-dashboard/lowongan/{{ $lowongan->slug }}/detail-pelamar/{{ $user->slug }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Application Form Pelamar</li>
                </ol>
            </nav>
            <h3 class="fw-bold">Application Form {{ $user->pelamar->nama_pelamar }}</h3>

        </div>

        <div class="container">
            <div class="row mb-5">
                @foreach ($datas as $data)
                    @if ($data->lowongan->slug == $lowongan->slug)
                    
                        <div class="d-flex align-items-start col-3 border-end">
                            <div class="nav flex-column nav-pills me-3 " id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">

                                <button class="nav-link active text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-pribadi" type="button" role="tab"
                                    aria-controls="v-pills-data-pribadi" aria-selected="true">Data Pribadi</button>

                                <button class="nav-link text-start" id="v-pills-data-anak-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-anak" type="button" role="tab"
                                    aria-controls="v-pills-data-anak" aria-selected="false">Data Anak</button>

                                <button class="nav-link text-start" id="v-pills-disabled-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-keluarga" type="button" role="tab"
                                    aria-controls="v-pills-disabled" aria-selected="false">Data Keluarga</button>

                                <button class="nav-link text-start" id="v-pills-messages-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-hobi" type="button" role="tab"
                                    aria-controls="v-pills-messages" aria-selected="false">Data Hobi</button>

                                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-pengalaman-organisasi" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Data Pengalaman
                                    Organisasi</button>

                                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-kontak-darurat" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Data Kontak Darurat</button>

                                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-kondisi-kesehatan" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Data Kondisi Kesehatan
                                </button>

                                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-riwayat-pendidikan" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Data Riwayat
                                    Pendidikan</button>

                                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-riwayat-pekerjaan" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Data Riwayat Pekerjaan</button>

                                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-kemampuan-komputer" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Data Kemampuan
                                    Komputer</button>

                                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-penguasaan-bahasa" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Data Penguasaan Bahasa</button>

                                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-referensi" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Data Referensi</button>

                                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-data-riwayat-pelatihan" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Data Riwayat Pelatihan</button>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-data-pribadi" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab" tabindex="0">

                                    @include('dashboard.application-form-partials.data_pribadi')
                                </div>

                                <div class="tab-pane fade" id="v-pills-data-anak" role="tabpanel"
                                    aria-labelledby="v-pills-data-anak-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_anak')
                                </div>

                                <div class="tab-pane fade" id="v-pills-data-keluarga" role="tabpanel"
                                    aria-labelledby="v-pills-disabled-tab" tabindex="0">

                                    @include('dashboard.application-form-partials.data_keluarga')

                                </div>

                                <div class="tab-pane fade" id="v-pills-data-hobi" role="tabpanel"
                                    aria-labelledby="v-pills-messages-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_hobi')
                                </div>

                                <div class="tab-pane fade" id="v-pills-data-pengalaman-organisasi" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_pengalaman_organisasi')
                                </div>

                                <div class="tab-pane fade" id="v-pills-data-kontak-darurat" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_kontak_darurat')
                                </div>

                                <div class="tab-pane fade" id="v-pills-data-kondisi-kesehatan" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_kondisi_kesehatan')
                                </div>

                                <div class="tab-pane fade" id="v-pills-data-riwayat-pendidikan" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_riwayat_pendidikan')
                                </div>

                                <div class="tab-pane fade" id="v-pills-data-riwayat-pekerjaan" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_riwayat_pekerjaan')
                                </div>

                                <div class="tab-pane fade" id="v-pills-data-kemampuan-komputer" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_kemampuan_komputer') </div>

                                <div class="tab-pane fade" id="v-pills-data-penguasaan-bahasa" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_penguasaan_bahasa') </div>

                                <div class="tab-pane fade" id="v-pills-data-referensi" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_referensi')</div>

                                <div class="tab-pane fade" id="v-pills-data-riwayat-pelatihan" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    @include('dashboard.application-form-partials.data_riwayat_pelatihan') </div>

                            </div>

                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    @endauth


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>
