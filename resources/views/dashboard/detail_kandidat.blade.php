
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin-dashboard.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>
</head>

<body style="font-family: Poppins">
    @include('partials.navbar')

    @auth
        @include('partials.notification_admin')
    @endauth

    @if (session()->has('success change position'))
        <div class="container justify-content-center col-8 mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center">
                {{ session('success change position') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @elseif (session()->has('success send refererence check'))
        <div class="container justify-content-center col-8 mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center">
                {{ session('success send refererence check') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="container mt-5">
        @foreach ($datas as $data)
            @if ($data->lowongan->id == $lowongan->id)
                {{-- @dd($data->dokumenPelamarLowongan) --}}
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="/admin-dashboard/lowongan/{{ $data->lowongan->slug }}/kelola-kandidat">Kelola
                                Kandidat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pelamar</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="">
                        <h4 class="fw-bold">{{ $data->lowongan->nama_lowongan }}</h4>
                    </div>
                    <div class="card border-light mt-4 mb-4 col-lg-9">
                        <div class="card-body">
                            <div class="mt-2">
                                <h4 class="fw-bold">{{ $data->pelamar->nama_pelamar }} | <span
                                        class="badge rounded-pill text-bg-success fw-normal fs-6">{{ Str::title($data->statusLamaran[0]->status->nama_status) }}</span>
                                    @if ($data->statusLamaran[0]->status->nama_status == 'reference check')
                                        @if (in_array($data->id_pelamar_lowongan, $applicationFormId))
                                            <span class="badge rounded-pill fw-normal text-bg-success">Sudah Mengisi
                                                Application Form</span>
                                        @else
                                            <span class="badge rounded-pill fw-normal text-bg-danger">Belum Mengisi
                                                Application Form</span>
                                        @endif
                                    @endif
                                </h4>
                                <p>Melamar pada
                                    {{ \Carbon\Carbon::parse($data->tanggal_melamar)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y ') }}
                                </p>
                            </div>
                            <div class="row mt-2">
                                @if ($data->pelamar->telepon_rumah == null)
                                    <div class="col-md-6">
                                        <label class="labels fw-bold"><i class="fa-solid fa-phone"></i> Nomor
                                            Telepon</label>
                                        <p>{{ '-' }}</p>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label class="labels fw-bold"><i class="fa-solid fa-phone"></i> Nomor
                                            Telepon</label>
                                        <p>{{ $data->pelamar->telepon_rumah }}</p>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <label class="labels fw-bold"><i class="fa-solid fa-envelope"></i>
                                        Email</label>
                                    <p>{{ $data->pelamar->email }}</p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                @if ($data->pelamar->alamat == null && $data->pelamar->tanggal_lahir == null)
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
                                        <p>{{ $data->pelamar->alamat }}</p>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels fw-bold"><i class="fa-regular fa-calendar-days"></i>
                                            Tanggal
                                            Lahir</label>
                                        <p>{{ \Carbon\Carbon::parse($data->pelamar->tanggal_lahir)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y ') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-2">
                                @if ($data->pelamar->kebangsaan == null)
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
                                        <p>{{ $data->pelamar->kebangsaan }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels fw-bold"><i class="fa-solid fa-user"></i>
                                            Jenis Kelamin</label>
                                        <p>{{ $data->pelamar->jenis_kelamin }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-3 mb-3">
                                @if ($data->statusLamaran[0]->status->nama_status == 'reference check')
                                    <div class="">
                                        @if (in_array($data->id_pelamar_lowongan, $applicationFormId))
                                            <a
                                                href="/admin-dashboard/lowongan/{{ $data->lowongan->slug }}/detail-pelamar/{{ $data->pelamar->user->uuid }}/application-form">Lihat
                                                Application Form <i
                                                    class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                        @endif
                                    </div>
                                    <div class="accordion accordion-flush mt-4" id="accordionPanelsStayOpenExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button border-bottom border-2 fw-bold"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#reference-check" aria-expanded="true"
                                                    aria-controls="panelsStayOpen-collapseOne" style="color: #2b8f38">
                                                    REFERENCE CHECK
                                                </button>
                                            </h2>
                                            <div id="reference-check" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <table class="table table-hover  mb-5">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Instansi/Perusahaan</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">No Telepon</th>
                                                                <th scope="col">Tindakan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data->pelamar->pengalamanKerja as $key => $data_pengalaman_kerja)
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td>{{ $data_pengalaman_kerja->nama_perusahaan }}
                                                                    </td>
                                                                    <td>{{ $data_pengalaman_kerja->email_instansi }}
                                                                    </td>
                                                                    <td>{{ $data_pengalaman_kerja->telepon }}</td>
                                                                    <td>
                                                                        @if (in_array($data->id_pelamar_lowongan, $applicationFormId))
                                                                            <button type="button"
                                                                                class="btn btn-success"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#pengalaman-kerja-{{ $data_pengalaman_kerja->id }}"
                                                                                data-bs-whatever="@getbootstrap"><i
                                                                                    class="fa-solid fa-envelope"
                                                                                    style="color: #ffffff;"></i> Kirim
                                                                                Email</button>
                                                                        @else
                                                                            <button type="button"
                                                                                class="btn btn-success"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#pengalaman-kerja-{{ $data_pengalaman_kerja->id }}"
                                                                                data-bs-whatever="@getbootstrap"
                                                                                disabled><i
                                                                                    class="fa-solid fa-envelope"
                                                                                    style="color: #ffffff;"></i> Kirim
                                                                                Email</button>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <div class="modal fade"
                                                                    id="pengalaman-kerja-{{ $data_pengalaman_kerja->id }}"
                                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5"
                                                                                    id="exampleModalLabel">Reference
                                                                                    Check
                                                                                </h1>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Anda akan mengirimkan reference check
                                                                                    kepada
                                                                                    {{ $data_pengalaman_kerja->nama_perusahaan }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    data-bs-dismiss="modal">Batal</button>

                                                                                <form
                                                                                    action="/admin-dashboard/lowongan/{{ $data->lowongan->slug }}/detail-pelamar/reference-check"
                                                                                    method="POST">

                                                                                    @csrf

                                                                                    <input type="text"
                                                                                        name="nama_pelamar"
                                                                                        id="nama_pelamar"
                                                                                        value="{{ $data->pelamar->nama_pelamar }}"
                                                                                        hidden>

                                                                                    <input type="text"
                                                                                        name="nama_perusahaan"
                                                                                        id="nama_perusahaan"
                                                                                        value="{{ $data_pengalaman_kerja->nama_perusahaan }}"
                                                                                        hidden>

                                                                                    <input type="text"
                                                                                        name="posisi" id="posisi"
                                                                                        value="{{ $data_pengalaman_kerja->posisi }}"
                                                                                        hidden>

                                                                                    <input type="text"
                                                                                        name="email_referensi"
                                                                                        id="email_referensi"
                                                                                        value="{{ $data_pengalaman_kerja->email_instansi }}"
                                                                                        hidden>

                                                                                    <input type="text"
                                                                                        name="nama_lowongan"
                                                                                        id="nama_lowongan"
                                                                                        value="{{ $lowongan->nama_lowongan }}"
                                                                                        hidden>



                                                                                    <input type="text"
                                                                                        name="nama_karyawan"
                                                                                        id="nama_karyawan"
                                                                                        value="{{ auth()->user()->karyawan->nama_karyawan }}"
                                                                                        hidden>

                                                                                    <input type="text"
                                                                                        name="email_karyawan"
                                                                                        id="email_karyawan"
                                                                                        value="{{ auth()->user()->email }}"
                                                                                        hidden>


                                                                                    <button type="submit"
                                                                                        class="btn btn-success">Kirim
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Nama</th>
                                                                <th scope="col">Telepon</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">Hubungan</th>
                                                                <th scope="col">Tindakan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data->pelamar->referensi as $key => $data_referensi)
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td>{{ $data_referensi->nama_referensi }}</td>
                                                                    <td>{{ $data_referensi->telepon_referensi }}
                                                                    </td>
                                                                    <td>{{ $data_referensi->email_referensi }}</td>
                                                                    <td>{{ $data_referensi->hubungan_referensi }}
                                                                    </td>
                                                                    <td>
                                                                        @if (in_array($data->id_pelamar_lowongan, $applicationFormId))
                                                                            <button type="button"
                                                                                class="btn btn-success"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#referensi-{{ $data_referensi->id_referensi }}"
                                                                                data-bs-whatever="@getbootstrap"><i
                                                                                    class="fa-solid fa-envelope"
                                                                                    style="color: #ffffff;"></i> Kirim
                                                                                Email</button>
                                                                        @else
                                                                            <button type="button"
                                                                                class="btn btn-success"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#referensi-{{ $data_referensi->id_referensi }}"
                                                                                data-bs-whatever="@getbootstrap"
                                                                                disabled><i
                                                                                    class="fa-solid fa-envelope"
                                                                                    style="color: #ffffff;"></i> Kirim
                                                                                Email</button>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                <div class="modal fade"
                                                                    id="referensi-{{ $data_referensi->id_referensi }}"
                                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5"
                                                                                    id="exampleModalLabel">
                                                                                    Reference Check
                                                                                </h1>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Anda akan mengirimkan reference
                                                                                    check
                                                                                    kepada
                                                                                    {{ $data_referensi->nama_referensi }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    data-bs-dismiss="modal">Batal</button>

                                                                                <form
                                                                                    action="/admin-dashboard/lowongan/{{ $data->lowongan->slug }}/detail-pelamar/reference-check"
                                                                                    method="POST">

                                                                                    @csrf

                                                                                    <input type="text"
                                                                                        name="nama_pelamar"
                                                                                        id="nama_pelamar"
                                                                                        value="{{ $data->pelamar->nama_pelamar }}"
                                                                                        hidden>

                                                                                    <input type="text"
                                                                                        name="nama_referensi"
                                                                                        id="nama_referensi"
                                                                                        value="{{ $data_referensi->nama_referensi }}"
                                                                                        hidden>

                                                                                    <input type="text"
                                                                                        name="email_referensi"
                                                                                        id="email_referensi"
                                                                                        value="{{ $data_referensi->email_referensi }}"
                                                                                        hidden>

                                                                                    <input type="text"
                                                                                        name="nama_lowongan"
                                                                                        id="nama_lowongan"
                                                                                        value="{{ $lowongan->nama_lowongan }}"
                                                                                        hidden>



                                                                                    <input type="text"
                                                                                        name="nama_karyawan"
                                                                                        id="nama_karyawan"
                                                                                        value="{{ auth()->user()->karyawan->nama_karyawan }}"
                                                                                        hidden>

                                                                                    <input type="text"
                                                                                        name="email_karyawan"
                                                                                        id="email_karyawan"
                                                                                        value="{{ auth()->user()->email }}"
                                                                                        hidden>


                                                                                    <button type="submit"
                                                                                        class="btn btn-success">Kirim
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($data->statusLamaran[0]->status->nama_status == 'tes')

                                @elseif ($data->statusLamaran[0]->status->nama_status == 'penawaran')
                                    {{-- <a class="mt-3"
                                    href="/admin-dashboard/lowongan/detail-pelamar/beban-kerja/{{ $data->pelamar->user->slug }}">INSTRUMEN
                                    ANALISA EVALUASI BOBOT KERJA POSISI JABATAN <i
                                        class="fa-solid fa-up-right-from-square"></i></a> --}}

                                    {{-- @if (count($data_hasil_analisa) < 9)
                                        <a class="mt-3"
                                            href="/admin-dashboard/lowongan/{{ $lowongan->slug }}/instrumen-penilaian-beban-kerja/{{ $data->pelamar->user->slug }}">INSTRUMEN
                                            ANALISA EVALUASI BOBOT KERJA POSISI JABATAN <i
                                                class="fa-solid fa-up-right-from-square"></i></a>

                                        <a class="mt-3 btn btn-success"
                                            href="/admin-dashboard/lowongan/{{ $lowongan->slug }}/beban-kerja/{{ $data->pelamar->user->slug }}">
                                            Kirim Penawaran <i class="fa-solid fa-up-right-from-square" @disabled(true)></i></a>
                                    @else
                                        <a class="mt-3"
                                            href="/admin-dashboard/lowongan/{{ $lowongan->slug }}/instrumen-penilaian-beban-kerja/{{ $data->pelamar->user->slug }}">INSTRUMEN
                                            ANALISA EVALUASI BOBOT KERJA POSISI JABATAN <i
                                                class="fa-solid fa-up-right-from-square"></i></a> <br>
                                        <a class="mt-3 btn btn-success"
                                            href="/admin-dashboard/lowongan/{{ $lowongan->slug }}/beban-kerja/{{ $data->pelamar->user->slug }}">
                                            Kirim Penawaran <i class="fa-solid fa-up-right-from-square"></i></a>
                                    @endif --}}
                                @endif
                            </div>
                            <div>
                                <div class="accordion accordion-flush mt-4" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button border-bottom border-2 fw-bold"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#deskripsi"
                                                aria-expanded="true" aria-controls="panelsStayOpen-collapseOne"
                                                style="color: #2b8f38">
                                                DESKRIPSI
                                            </button>

                                        </h2>
                                        <div id="deskripsi" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                {!! $data->pelamar->deskripsi !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion accordion-flush mt-4" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button border-bottom border-2 fw-bold"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#pengalamanKerja" aria-expanded="true"
                                                aria-controls="panelsStayOpen-collapseOne" style=" color: #2b8f38">
                                                PENGALAMAN KERJA
                                            </button>

                                        </h2>
                                        <div id="pengalamanKerja" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                @if (in_array($data->pelamar->id, $arrPengalamanId))
                                                    @foreach ($data->pelamar->pengalamanKerja as $data_pengalaman_kerja)
                                                        <div class="border-start px-3 border-4 border-secondary">
                                                            <p class="fw-bold">
                                                                {{ $data_pengalaman_kerja->nama_perusahaan }}
                                                            </p>
                                                            <p>{{ $data_pengalaman_kerja->posisi }}
                                                            </p>
                                                            <p>{{ $data_pengalaman_kerja->periode }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="d-flex justify-content-center">
                                                        <p>Belum ada data yang ditambahkan</p>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion accordion-flush mt-4" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button border-bottom border-2 fw-bold"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#pendidikan"
                                                aria-expanded="true" aria-controls="panelsStayOpen-collapseOne"
                                                onclick="changeColor(3)" style=" color: #2b8f38">
                                                PENDIDIKAN
                                            </button>

                                        </h2>
                                        <div id="pendidikan" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                @if (in_array($data->pelamar->id, $arrPendidikanId))
                                                    @foreach ($data->pelamar->pendidikan as $data_status_pendidikan)
                                                        <div class="border-start px-3 border-4 border-secondary">
                                                            <p>Jenjang:
                                                                {{ $data_status_pendidikan->jenjang_pendidikan }}
                                                            </p>
                                                            <p>Jurusan:
                                                                {{ $data_status_pendidikan->jurusan }}
                                                            </p>
                                                            <p>IPK: {{ $data_status_pendidikan->ipk }}
                                                            </p>

                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="d-flex justify-content-center">
                                                        <p>Belum ada data yang ditambahkan</p>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion accordion-flush mt-4 mb-5" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button border-bottom border-2 fw-bold"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#dokumen"
                                                aria-expanded="true" aria-controls="panelsStayOpen-collapseOne"
                                                onclick="changeColor(4)" style="color: #2b8f38">
                                                DOKUMEN
                                            </button>

                                        </h2>
                                        <div id="dokumen" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        @foreach ($data->dokumenPelamarLowongan as $dd)
                                                            @if ($dd->id_pelamar_lowongan == $data->id_pelamar_lowongan)
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link" id="resume-tab"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#tab-pane-seleksi-{{ $dd->id_dokumen }}"
                                                                        type="button" role="tab"
                                                                        aria-selected="true">{{ \Illuminate\Support\Str::limit($dd->dokumenPelamar->nama_dokumen, $limit = 20, '...') }}</button>
                                                                </li>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                    @foreach ($data->dokumenPelamarLowongan as $dd)
                                                        @if ($dd->id_dokumen == 1)
                                                            <div class="tab-pane fade show active"
                                                                id="tab-pane-seleksi-{{ $dd->id_dokumen }}"
                                                                role="tabpanel" aria-labelledby="home-tab"
                                                                tabindex="0">
                                                                <embed
                                                                    src="{{ asset('storage/' . $dd->dokumenPelamar->path) }}"
                                                                    type="application/pdf" width="100%"
                                                                    height="800px" />
                                                            </div>
                                                        @else
                                                            <div class="tab-pane fade"
                                                                id="tab-pane-seleksi-{{ $dd->id_dokumen }}"
                                                                role="tabpanel" aria-labelledby="home-tab"
                                                                tabindex="0">
                                                                <embed
                                                                    src="{{ asset('storage/' . $dd->dokumenPelamar->path) }}"
                                                                    type="application/pdf" width="100%"
                                                                    height="800px" />
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        @if ($data->statusLamaran[0]->status->nama_status == 'penawaran')
                            <div class="card shadow-sm" style="width: 20rem; ">
                                <div class="card-body">
                                    <div class="mt-2">
                                        <p>Kelengkapan analisa bobot beban kerja</p>
                                    </div>
                                    <div class="progress" role="progressbar" aria-label="Example with label"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-success"
                                            style="width: {{ (count($hasil_analisa_exists) / count($tipe_analisa)) * 100 }}%">
                                            {{ number_format((count($hasil_analisa_exists) / count($tipe_analisa)) * 100, 2) }}%
                                        </div>
                                    </div>
                                    <h6 class="mt-2">{{ count($hasil_analisa_exists) }}/{{ count($tipe_analisa) }}
                                        terisi</h6>
                                    <a class="mt-3"
                                        href="/admin-dashboard/lowongan/{{ $lowongan->slug }}/instrumen-penilaian-beban-kerja/{{ $data->pelamar->user->uuid }}">INSTRUMEN
                                        ANALISA EVALUASI BOBOT KERJA POSISI JABATAN <i
                                            class="fa-solid fa-up-right-from-square"></i></a>

                                    @if (count($hasil_analisa_exists) < 9)
                                        <a class="mt-3 btn btn-success disabled" role="button">
                                            Penawaran</a>
                                        <p class="text-danger">Belum terisi semua</p>
                                    @else
                                        <a class="mt-3 btn btn-success" role="button"
                                            href="/admin-dashboard/lowongan/{{ $lowongan->slug }}/detail-pelamar/beban-kerja/{{ $data->pelamar->user->uuid }}">
                                            Penawaran</a>
                                    @endif

                                </div>
                            </div>
                        @endif
                        <div class="card mt-4 mb-4 shadow-sm" style="width: 20rem; ">
                            <div class="card-body">
                                <h5 class="card-title">Status Lamaran</h5>
                                <p class="card-text">
                                    {{ Str::title($data->statusLamaran[0]->status->nama_status) }}</p>
                                <hr>
                                
                                @if ($data->statusLamaran[0]->status->nama_status == 'ditolak')
                                    <div class="">
                                        <button type="button" class="btn btn-danger" disabled>Pelamar sudah
                                            ditolak/Tidak
                                            masuk kriteria</button>
                                    </div>
                                @else
                                    <div class="row">
                                        @if (in_array($data->id_pelamar_lowongan, $applicationFormId))
                                            @if ($data->statusLamaran[0]->status->nama_status == 'direkrut')
                                                <div class="col">
                                                    <button type="button" class="btn btn-success" disabled>Pelamar
                                                        Sudah Direkrut</button>
                                                </div>
                                            @elseif($data->statusLamaran[0]->status->nama_status == 'penawaran' && $data_penawaran_exist == false)
                                                <div class="col">
                                                    <p>Pindahkan ke </p>
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#id-{{ $data_next_status[0]->id }}"
                                                        name="button_status_name"
                                                        value="{{ $data_next_status[0]->id }}"
                                                        id="button_status_seleksi-{{ $data_next_status[0]->id }}"
                                                        disabled>
                                                        {{ Str::title($data_next_status[0]->nama_status) }}
                                                    </button>
                                                </div>
                                                <div class="col">
                                                    <p>Atau</p>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-toggle="modal"
                                                        id="button_status_seleksi-{{ $data_status_ditolak->id }}"
                                                        value="{{ $data_status_ditolak->id }}"
                                                        data-bs-target="#ditolak-{{ $data_status_ditolak->id }}">
                                                        Ditolak
                                                    </button>
                                                </div>
                                            @elseif ($data->statusLamaran[0]->status->nama_status == 'penawaran' && $data_penawaran[0]->status_penawaran == 'tolak')
                                                <div class="">
                                                    <button type="button" class="btn btn-danger" disabled>Pelamar
                                                        menolak penawaran</button>
                                                </div>
                                                <div class="">
                                                    <p class="mt-2">Pindahkan ke</p>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-toggle="modal"
                                                        id="button_status_seleksi-{{ $data_status_ditolak->id }}"
                                                        value="{{ $data_status_ditolak->id }}"
                                                        data-bs-target="#ditolak-{{ $data_status_ditolak->id }}">
                                                        Ditolak
                                                    </button>
                                                </div>
                                            @elseif ($data->statusLamaran[0]->status->nama_status == 'penawaran' && $data_penawaran[0]->status_penawaran == 'terima')
                                                <div class="col mt-2">
                                                    <p>Pindahkan ke </p>
                                                    <button type="button" class="btn btn-success "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#id-{{ $data_next_status[0]->id }}"
                                                        name="button_status_name"
                                                        value="{{ $data_next_status[0]->id }}"
                                                        id="button_status_seleksi-{{ $data_next_status[0]->id }}">
                                                        {{ Str::title($data_next_status[0]->nama_status) }}
                                                    </button>
                                                </div>
                                                <div class="col mt-2">
                                                    <p>Atau</p>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-toggle="modal"
                                                        id="button_status_seleksi-{{ $data_status_ditolak->id }}"
                                                        value="{{ $data_status_ditolak->id }}"
                                                        data-bs-target="#ditolak-{{ $data_status_ditolak->id }}">
                                                        Ditolak
                                                    </button>
                                                </div>
                                            @else
                                                <div class="col">
                                                    <p>Pindahkan ke </p>
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#id-{{ $data_next_status[0]->id }}"
                                                        name="button_status_name"
                                                        value="{{ $data_next_status[0]->id }}"
                                                        id="button_status_seleksi-{{ $data_next_status[0]->id }}">
                                                        {{ Str::title($data_next_status[0]->nama_status) }}
                                                    </button>
                                                </div>
                                                <div class="col">
                                                    <p>Atau</p>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-toggle="modal"
                                                        id="button_status_seleksi-{{ $data_status_ditolak->id }}"
                                                        value="{{ $data_status_ditolak->id }}"
                                                        data-bs-target="#ditolak-{{ $data_status_ditolak->id }}">
                                                        Ditolak
                                                    </button>

                                                </div>
                                            @endif
                                        @elseif (
                                            !in_array($data->id_pelamar_lowongan, $applicationFormId) &&
                                                $data->statusLamaran[0]->status->nama_status != 'reference check')
                                            <div class="col">
                                                <p>Pindahkan ke </p>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#id-{{ $data_next_status[0]->id }}"
                                                    name="button_status_name" value="{{ $data_next_status[0]->id }}"
                                                    id="button_status_seleksi-{{ $data_next_status[0]->id }}">
                                                    {{ Str::title($data_next_status[0]->nama_status) }}
                                                </button>
                                            </div>
                                            <div class="col">
                                                <p>Atau</p>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-toggle="modal"
                                                    id="button_status_seleksi-{{ $data_status_ditolak->id }}"
                                                    value="{{ $data_status_ditolak->id }}"
                                                    data-bs-target="#ditolak-{{ $data_status_ditolak->id }}">
                                                    Ditolak
                                                </button>

                                            </div>
                                        @else
                                            <div class="col">
                                                <p>Pindahkan ke </p>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#id-{{ $data_next_status[0]->id }}"
                                                    name="button_status_name" value="{{ $data_next_status[0]->id }}"
                                                    id="button_status_seleksi-{{ $data_next_status[0]->id }}"
                                                    disabled>
                                                    {{ Str::title($data_next_status[0]->nama_status) }}
                                                </button>
                                            </div>
                                            <div class="col">
                                                <p>Atau</p>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-toggle="modal"
                                                    id="button_status_seleksi-{{ $data_status_ditolak->id }}"
                                                    value="{{ $data_status_ditolak->id }}"
                                                    data-bs-target="#ditolak-{{ $data_status_ditolak->id }}" disabled>
                                                    Ditolak
                                                </button>

                                            </div>
                                        @endif

                                    </div>


                                    {{-- modal ditolak --}}
                                    <div class="modal fade" id="ditolak-{{ $data_status_ditolak->id }}"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        Apa
                                                        Sudah
                                                        Yakin?
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Pelamar akan dipindahkan ke status
                                                    {{ $data_status_ditolak->nama_status }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form
                                                        action="/admin-dashboard/lowongan/{{ $data->statusLamaran[0]->id_status_lamaran }}/changePosition"
                                                        method="POST" id="changePosition">
                                                        @csrf
                                                        <input type="date" name="tanggal" id="tanggal"
                                                            value="{{ date('Y-m-d') }}" hidden>

                                                        <input type="text" name="approved_by" id="approved_by"
                                                            value="{{ auth()->user()->id_karyawan }}" hidden>

                                                        <input type="text" name="nama_karyawan" id="approved_by"
                                                            value="{{ auth()->user()->karyawan->nama_karyawan }}"
                                                            hidden>

                                                        <input type="text" name="id_pelamar_lowongan"
                                                            value="{{ $data->id_pelamar_lowongan }}" hidden>

                                                        <input type="text" name="nama_pelamar" id="nama_pelamar"
                                                            value="{{ $data->pelamar->nama_pelamar }}" hidden>

                                                        <form action="/sendEmail" method="POST" id="sendEmail">
                                                            @csrf

                                                            <input type="email" name="email" id="email"
                                                                value="{{ $data->pelamar->email }}" hidden>

                                                            <input type="text" name="status_kandidat"
                                                                id="status_kandidat"
                                                                value="{{ $data_status_ditolak->nama_status }}"
                                                                hidden>

                                                            <button class="btn btn-success btn-tolak" type="submit"
                                                                name="id_status"
                                                                value="{{ $data_status_ditolak->id }}"
                                                                id="id_status_seleksi_page-{{ $data_status_ditolak->id }}"
                                                                onclick="getData({{ $data_status_ditolak->id }});">Pindahkan
                                                            </button>

                                                        </form>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- modal status --}}
                                    <div class="modal fade" id="id-{{ $data_next_status[0]->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        Apa sudah yakin?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Pelamar akan dipindahkan ke status
                                                    {{ Str::title($data_next_status[0]->nama_status) }}

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form
                                                        action="/admin-dashboard/lowongan/{{ $data->statusLamaran[0]->id_status_lamaran }}/changePosition"
                                                        method="POST" id="changePosition">
                                                        @csrf
                                                        <input type="date" name="tanggal" id="tanggal"
                                                            value="{{ date('Y-m-d') }}" hidden>

                                                        <input type="text" name="approved_by" id="approved_by"
                                                            value="{{ auth()->user()->id_karyawan }}" hidden>

                                                        <input type="text" name="nama_karyawan" id="approved_by"
                                                            value="{{ auth()->user()->karyawan->nama_karyawan }}"
                                                            hidden>

                                                        <input type="text" name="id_pelamar_lowongan"
                                                            value="{{ $data->id_pelamar_lowongan }}" hidden>

                                                        <input type="text" name="nama_pelamar" id="nama_pelamar"
                                                            value="{{ $data->pelamar->nama_pelamar }}" hidden>

                                                        <input type="text" name="slug_pelamar" id="slug_pelamar"
                                                            value="{{ $data->pelamar->user->slug }}" hidden>

                                                        <input type="text" name="slug_lowongan" id="slug_lowongan"
                                                            value="{{ $data->lowongan->slug }}" hidden>

                                                        <form action="/sendEmail" method="POST" id="sendEmail">
                                                            @csrf

                                                            <input type="email" name="email" id="email"
                                                                value="{{ $data->pelamar->email }}" hidden>


                                                            <input type="text" name="status_kandidat"
                                                                id="status_kandidat"
                                                                value="{{ $data_next_status[0]->nama_status }}"
                                                                hidden>

                                                            <button class="btn btn-success btn-pindahkan"
                                                                type="submit" name="id_status"
                                                                value="{{ $data_next_status[0]->id }}"
                                                                id="id_status_seleksi_page-{{ $data_next_status[0]->id }}"
                                                                onclick="getData({{ $data_next_status[0]->id }});">Pindahkan
                                                            </button>

                                                        </form>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card mt-5 mb-4 shadow-sm" style="width: 20rem; max-height: 400px">
                            <div class="card-header">
                                <h5 class="card-title">Riwayat Aktivitas</h5>
                                <p class="card-text mb-2 text-body-secondary">Menampilkan
                                    {{ count($data->activityLog) }} aktivitas</p>

                            </div>
                            <div class="card-body overflow-auto">

                                @foreach ($data->activityLog->sortDesc() as $data_activity)
                                    <p>- <strong>{!! $data->statusLamaran[0]->karyawan->nama_karyawan == null
                                        ? ''
                                        : $data->statusLamaran[0]->karyawan->nama_karyawan !!}</strong>
                                        memproses
                                        pelamar ini ke tahap

                                        <strong>{{ Str::title($data_activity->status[0]->nama_status) }}</strong>
                                        pada
                                        {{ \Carbon\Carbon::parse($data_activity->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y H:i') }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        @endforeach
    </div>
    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="mx-2 fw-bold text-light">Loading...</div>
    </div>
    <div id="loader" class="loader-wrapper" style="display: none;">
        <div class="loader"></div>
        <div class="mx-2 fw-bold text-light">Loading...</div>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

<script>
    window.addEventListener("load", function() {
        const loader = document.querySelector(".loader-wrapper");
        const content = document.querySelector(".content");

        // Hide the loader
        loader.style.display = "none";

    });

    document.addEventListener('DOMContentLoaded', function() {
        // Replace 'your_id_here' with the dynamic ID you want to use
        const pindahkan = document.getElementsByClassName("btn-pindahkan");
        const tolak = document.getElementsByClassName("btn-tolak");


        for (let index = 0; index < pindahkan.length; index++) {
            const edit = pindahkan[index].value;
            getID(edit);
        }

        for (let index = 0; index < tolak.length; index++) {
            const deletes = tolak[index].value;

            getID(deletes);
        }


    });

    function getID(id) {
        // Use the 'id' parameter to create the dynamic button ID
        var button = document.getElementById('id_status_seleksi_page-' + id);

        if (button) {
            button.addEventListener('click', function() {
                const loader = document.getElementById('loader');

                // Display the loader
                loader.style.display = 'flex';

                // Simulate a form submission delay (replace with your actual form submission logic)
                setTimeout(function() {
                    // Hide the loader when the form submission is complete
                    loader.style.display = 'none';


                }, 6000);
            });
        }
        var button = document.getElementById('id_status_seleksi_page-' + id);

        if (button) {
            button.addEventListener('click', function() {
                const loader = document.getElementById('loader');

                // Display the loader
                loader.style.display = 'flex';

                // Simulate a form submission delay (replace with your actual form submission logic)
                setTimeout(function() {
                    // Hide the loader when the form submission is complete
                    loader.style.display = 'none';


                }, 3000);
            });
        }
    }



    function hapusData() {
        document.getElementById("formAddScheduleTest").reset();
    }


    function getData(id) {

        var button_status_seleksi = document.getElementById('button_status_seleksi-' + id);
        var value_button_status_seleksi = button_status_seleksi.getAttribute('value');

        var id_status_seleksi_page = document.getElementById('id_status_seleksi_page-' + id)
        id_status_seleksi_page.value = value_button_status_seleksi;

        var status_kandidat = document.getElementById('status_kandidat');
        status_kandidat.value = button_status_seleksi.innerHTML;

    }
</script>
