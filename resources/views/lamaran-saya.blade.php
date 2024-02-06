{{-- @dd($datas) --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main-style.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>

</head>

<body style="font-family: Poppins;">

    @include('partials.navbar')

    @auth
        @include('partials.notification_pelamar')
    @endauth

    @if (session()->has('success send application form'))
        <div class="container justify-content-center col-8 mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center">
                {{ session('success send application form') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="container">
        <nav class="mt-5" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/lowongan-kerja">Lowongan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lamaran Saya</li>
            </ol>
        </nav>

        @if (count($datas) == 0)
            <h3 class="mt-5 text-center fw-bold">Anda belum mendaftar lowongan apapun</h3>
        @else
            @foreach ($datas as $data)
                @foreach ($lowonganId as $lowongan)
                    @if ($data->lowongan->id == $lowongan->id_lowongan)
                        <div class="row mt-4">
                            <div class="col-9 ">
                                <div class="mt-5 ">
                                    <h5 class="fw-bold">{{ $data->lowongan->nama_lowongan }}</h5>
                                    <p>Yayasan SATUNAMA - Yogyakarta, Indonesia</p>
                                    @if ($data->statusLamaran[0]->status->nama_status == 'ditolak')
                                        <p><span class="badge rounded-pill text-bg-danger">
                                                {{ Str::title($data->statusLamaran[0]->status->nama_status) }}</span>
                                        @else
                                        <p><span class="badge rounded-pill text-bg-success">Tahap
                                                {{ Str::title($data->statusLamaran[0]->status->nama_status) }}</span>
                                    @endif
                                    @if ($data->lowongan->closed != true)
                                        - Lowongan Dibuka
                                    @else
                                        - Lowongan Ditutup
                                    @endif
                                    </p>
                                </div>

                                @if ($data->statusLamaran[0]->status->slug == 'reference-check')
                                    @if (in_array($data->id_pelamar_lowongan, $applicationformId))
                                        <div class="mt-4">
                                            {{-- <a href="/profil-kandidat/users/{{ $user->slug }}/application-form/{{ $data->lowongan->slug }}"
                                            style="text-decoration: none; color: blue" class="btn border-0 disabled">
                                            <i class="fa-solid fa-up-right-from-square"></i>
                                            Isi Application Form</a> --}}
                                            <span class="badge text-bg-success"><i class="fa-solid fa-check"
                                                    style="color: #ffffff;"></i> Sudah
                                                Mengisi Application Form</span>
                                        </div>
                                    @else
                                        {{-- <div class="mt-4">
                                            <a href="/profil-kandidat/users/{{ $user->slug }}/application-form/{{ $data->lowongan->slug }}"
                                                style="text-decoration: none; color: blue" class="link-application-form"
                                                id="button-link-application-form-{{ $data->lowongan->slug }}"
                                                data-pk-id="{{ $data->lowongan->slug }}"
                                                onclick="getID({{ $data->lowongan->slug }})"><i
                                                    class="fa-solid fa-up-right-from-square"></i>
                                                Isi Application Form</a> <span class="badge text-bg-danger"><i
                                                    class="fa-solid fa-xmark" style="color: #ffffff;"></i> Belum
                                                Diisi</span>
                                        </div> --}}
                                        <div class="mt-4">
                                            <a href="/{{ $data->lowongan->slug }}/application-form"
                                                style="text-decoration: none; color: blue" class="link-application-form"
                                                id="button-link-application-form-{{ $data->lowongan->slug }}"
                                                data-pk-id="{{ $data->lowongan->slug }}"
                                                onclick="getID({{ $data->lowongan->slug }})"><i
                                                    class="fa-solid fa-up-right-from-square"></i>
                                                Isi Application Form</a> <span class="badge text-bg-danger"><i
                                                    class="fa-solid fa-xmark" style="color: #ffffff;"></i> Belum
                                                Diisi</span>
                                        </div>
                                    @endif
                                @elseif ($data->statusLamaran[0]->status->slug == 'penawaran')
                                    <a class="btn btn-primary"
                                        href="/profil-kandidat/users/{{ $user->slug }}/offering/{{ $data->lowongan->slug }}"
                                        role="button">Buka Penawaran</a>
                                @endif
                                <div class="accordion accordion-flush mt-5" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed border-bottom border-2 fw-bold"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseOne-{{ $data->statusLamaran[0]->id_pelamar_lowongan }}"
                                                aria-expanded="false"
                                                aria-controls="flush-collapseOne-{{ $data->statusLamaran[0]->id_pelamar_lowongan }}"
                                                style="color: #2b8f38">
                                                TRACKING STATUS LAMARAN
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne-{{ $data->statusLamaran[0]->id_pelamar_lowongan }}"
                                            class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <table class="table table-borderless " id="table">
                                                    <tbody>
                                                        @if (count($data->activityLog) == 0)
                                                            <p class="text-center">HRD belum memproses lamaran Anda</p>
                                                        @else
                                                            @foreach ($data->activityLog->sortdesc() as $data_activity)
                                                                @if ($loop->first)
                                                                    <tr class="table-active fw-bold"
                                                                        style="color: blue">
                                                                        <td> <i
                                                                                class="fa-solid fa-square-full fa-2xs"></i>
                                                                            {{ \Carbon\Carbon::parse($data_activity->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y H:i ') }}
                                                                        </td>
                                                                        <td>Proses lamaran sudah sampai tahap
                                                                            {{ $data_activity->status[0]->nama_status }}
                                                                        </td>
                                                                    </tr>
                                                                    @continue
                                                                @endif
                                                                <tr>
                                                                    <td> <i class="fa-solid fa-square-full fa-2xs"
                                                                            style="color: #c3c1c1;"></i>
                                                                        {{ \Carbon\Carbon::parse($data_activity->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y H:i ') }}
                                                                    </td>
                                                                    <td>Proses lamaran sudah sampai tahap
                                                                        {{ $data_activity->status[0]->nama_status }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion accordion-flush mt-4 mb-5" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed border-bottom border-2 fw-bold"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#dokumen-{{ $data->id_pelamar_lowongan }}"
                                                aria-expanded="false" aria-controls="flush-collapseOne"
                                                style="color: #2b8f38">
                                                DOKUMEN
                                            </button>
                                        </h2>
                                        <div id="dokumen-{{ $data->id_pelamar_lowongan }}"
                                            class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        {{-- @foreach ($datas as $data) --}}
                                                        @foreach ($data->dokumenPelamarLowongan as $dd)
                                                            @if ($dd->id_pelamar_lowongan == $data->id_pelamar_lowongan)
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link" id="resume-tab"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#tab-pane-seleksi-{{ $dd->id_dokumen }}"
                                                                        type="button" role="tab"
                                                                        aria-selected="true">{{ \Illuminate\Support\Str::limit($dd->dokumenPelamar->nama_dokumen, $limit = 30, '...') }}</button>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                        {{-- @endforeach --}}
                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                    @foreach ($data->dokumenPelamarLowongan as $dd)
                                                        <div class="tab-pane fade show"
                                                            id="tab-pane-seleksi-{{ $dd->id_dokumen }}"
                                                            role="tabpanel" aria-labelledby="home-tab"
                                                            tabindex="0">
                                                            <embed
                                                                src="{{ asset('storage/' . $dd->dokumenPelamar->path) }}"
                                                                type="application/pdf" width="100%"
                                                                height="800px" />
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="mt-5">
                                    <h5 class="fw-bold">Rincian Pekerjaan</h5>
                                </div>
                                <div>
                                    <p><i class="fa-solid fa-building"></i>
                                        {{ $data->lowongan->departemen->nama_departemen }}
                                    </p>
                                    <p><i class="fa-solid fa-hourglass-start"></i>
                                        {{ $data->lowongan->tipe_lowongan }}
                                    </p>
                                    <p><a href="/lowongan-kerja/{{ $data->lowongan->slug }}/detail"
                                            style="text-decoration: none; color: blue"><i
                                                class="fa-solid fa-up-right-from-square"></i>
                                            Lihat detail lowongan</a></p>
                                </div>
                            </div>
                    @endif
                @endforeach
            @endforeach

        @endif
    </div>

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
</body>

</html>

<script src="{{ asset('js/lamaran-saya.js') }}"></script>
