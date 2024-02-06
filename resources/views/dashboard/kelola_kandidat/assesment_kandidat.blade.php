<div class="tab-pane fade show" id="pills-tes" role="tabpanel" aria-labelledby="pills-reference-check-tab"
    tabindex="0">
    <div class="container mt-4 rounded border border-1" id="kandidat_container">
        <div class="row " id="kandidat">
            @if (count($tes) > 0)
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama & Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Posisi Terakhir</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($tes); $i++)
                            <tr class="text-center">
                                <th scope="row">{{ $i + 1 }}</th>
                                <td>{{ $tes[$i]['pelamar']['nama_pelamar'] }} {!! nl2br('<br>') !!}
                                    {{ $tes[$i]['pelamar']['alamat'] }}</td>
                                <td>{{ $tes[$i]['pelamar']['email'] }}</td>
                                <td>{{ $tes[$i]['pelamar']['jenis_kelamin'] != null ? $tes[$i]['pelamar']['jenis_kelamin'] : 'Belum diisi' }}
                                </td>
                                <td>{{ $tes[$i]['pelamar']['telepon_rumah'] }}</td>
                                @if ($tes[$i]['pelamar']['pengalaman_kerja'] != null)
                                    <td>
                                        @for ($j = 0; $j < count($tes[$i]['pelamar']['pengalaman_kerja']); $j++)
                                            {{ $tes[$i]['pelamar']['pengalaman_kerja'][$j]['posisi'] }}
                                            {!! nl2br('<br>') !!}
                                        @endfor
                                    </td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>
                                    <a href="/admin-dashboard/lowongan/{{ $datas[0]->lowongan->slug }}/detail-pelamar/{{ $tes[$i]['pelamar']['user']['uuid'] }}"
                                        class="btn btn-success btn-detail fw-semibold text-white"
                                        id="button-detail-{{ $tes[$i]['pelamar']['user']['slug'] }}"
                                        data-pk-id="{{ $tes[$i]['pelamar']['user']['slug'] }}"
                                       ><i
                                            class="bi bi-info-circle-fill"></i> Detail </a>

                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            @else
                <div class="container col-12 mt-4 ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('img/search.png') }}" alt="" class="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="mt-3 fw-semibold">Tidak ada pelamar ditahap ini</p>
                    </div>

                </div>
            @endif

        </div>

    </div>
</div>


{{-- <div class="tab-pane fade" id="pills-tes" role="tabpanel" aria-labelledby="pills-tes-tab" tabindex="0">
    <div class="container border">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addTest">
            Tambah Jadwal Tes
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addTest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Jadwal Tes Tertulis
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/admin-dashboard/lowongan/addScheduleTest" method="POST" id="formAddScheduleTest">
                        @csrf
                        <div class="modal-body">
                            <div class="col-9">
                                <label for="nama_pelamar" class="form-label">Nama Pelamar</label>
                                <select class="form-select mb-3" aria-label="Default select example" id="nama_pelamar"
                                    name="nama_pelamar">
                                    <option selected disabled>Pilih Nama Pelamar</option>
                                    @foreach ($datas as $data)
                                        <option value="{{ old($data->pelamar->nama_pelamar) }}">
                                            {{ $data->pelamar->nama_pelamar }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-9">
                                <div class="mb-3">
                                    <label for="tanggal_tes" class="form-label">Tanggal
                                        Tes</label>
                                    <input type="date" class="form-control" id="tanggal_tes"
                                        placeholder="Tanggal Tes" name="tanggal_tes" value="{{ old('tanggal_tes') }}">
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="mb-3">
                                    <label for="waktu_mulai" class="form-label">Waktu
                                        Mulai</label>
                                    <input type="time" class="form-control" id="waktu_mulai"
                                        placeholder="Waktu Mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}">
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="mb-3">
                                    <label for="waktu_selesai" class="form-label">Waktu
                                        Selesai</label>
                                    <input type="time" class="form-control" id="waktu_selesai"
                                        placeholder="Waktu Selesai" name="waktu_selesai"
                                        value="{{ old('waktu_selesai') }}">
                                </div>
                            </div>
                            <div class="col-9" hidden>
                                <div class="mb-3">
                                    <label for="id_pelamar_lowongan" class="form-label">id_pelamar_lowongan</label>
                                    <input type="text" class="form-control" id="id_pelamar_lowongan"
                                        placeholder="id pelamar lowongan" name="id_pelamar_lowongan">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                onclick="hapusData()">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="mt-3">
            <table class="table table-borderless table-responsive">
                <thead class="">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Tanggal Tes</th>
                        <th scope="col" class="text-center">Waktu</th>
                        <th scope="col" class="text-center">Tim Seleksi</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <td class="text-center">{{ $data->tesTertulis->nama_pelamar }}</td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($data->tesTertulis->tanggal_tes)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}
                            </td>
                            <td class="text-center">{{ $data->tesTertulis->waktu_mulai }} -
                                {{ $data->tesTertulis->waktu_selesai }}</td>
                            <td></td>
                            <td>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#edit-schedule-{{ $data->tesTertulis->id_tes_tertulis }}">
                                    <i class="bi bi-pencil-fill"></i>
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="edit-schedule-{{ $data->tesTertulis->id_tes_tertulis }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Jadwal Tes Tertulis</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="/admin-dashboard/tesTertulis/edit-schedule/{{ $data->tesTertulis->id_tes_tertulis }}"
                                                    method="POST" id="formEditScheduleTest">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="col-9">
                                                            <label for="nama_pelamar" class="form-label">Nama
                                                                Pelamar</label>
                                                            <select class="form-select mb-3"
                                                                aria-label="Default select example" id="nama_pelamar"
                                                                name="nama_pelamar">
                                                                <option selected disabled>Pilih Nama
                                                                    Pelamar
                                                                </option>
                                                                @foreach ($datas as $data)
                                                                    <option
                                                                        value="{{ old('nama_pelamar', $data->pelamar->nama_pelamar) }}">
                                                                        {{ $data->pelamar->nama_pelamar }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="mb-3">
                                                                <label for="tanggal_tes" class="form-label">Tanggal
                                                                    Tes</label>
                                                                <input type="date" class="form-control"
                                                                    id="tanggal_tes" placeholder="Tanggal Tes"
                                                                    name="tanggal_tes"
                                                                    value="{{ $data->tesTertulis->tanggal_tes }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="mb-3">
                                                                <label for="waktu_mulai" class="form-label">Waktu
                                                                    Mulai</label>
                                                                <input type="time" class="form-control"
                                                                    id="waktu_mulai" placeholder="Waktu Mulai"
                                                                    name="waktu_mulai"
                                                                    value="{{ $data->tesTertulis->waktu_mulai }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="mb-3">
                                                                <label for="waktu_selesai" class="form-label">Waktu
                                                                    Selesai</label>
                                                                <input type="time" class="form-control"
                                                                    id="waktu_selesai" placeholder="Waktu Selesai"
                                                                    name="waktu_selesai"
                                                                    value="{{ $data->tesTertulis->waktu_selesai }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-9" hidden>
                                                            <div class="mb-3">
                                                                <label for="id_pelamar_lowongan"
                                                                    class="form-label">id_pelamar_lowongan</label>
                                                                <input type="text" class="form-control"
                                                                    id="id_pelamar_lowongan"
                                                                    placeholder="id pelamar lowongan"
                                                                    name="id_pelamar_lowongan"
                                                                    value="{{ $data->tesTertulis->id_pelamar_lowongan }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                            onclick="hapusData()">Keluar</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <a href="" class="btn btn-danger border-0" data-bs-toggle="modal"
                                    data-bs-target="#"><i class="bi bi-trash3-fill"></i>
                                    Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div> --}}

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin-dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>

</head>

<body style="font-family: Poppins">
    @include('partials.navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h4 class="fw-bold">{{ $datas->lowongan->nama_lowongan }}</h4>
            </div>
            <div class="col-7">

            </div>
            <div class="card mt-4 mb-4">
                <div class="card-body">
                    <div class="mt-2">
                        <h4 class="fw-bold">{{ $datas->pelamar->nama_pelamar }} | <span
                                class="badge rounded-pill text-bg-info">{{ Str::title($datas->statusLamaran[0]->status->nama_status) }}</span>
                        </h4>
                        <p>Melamar
                            {{ \Carbon\Carbon::parse($datas->tanggal_melamar)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y ') }}
                        </p>
                    </div>
                    <div class="row mt-2">
                        @if ($datas->pelamar->telepon_rumah == null)
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-phone"></i> Nomor
                                    Telepon</label>
                                <p>{{ '-' }}</p>
                            </div>
                        @else
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-phone"></i> Nomor
                                    Telepon</label>
                                <p>{{ $datas->pelamar->telepon_rumah }}</p>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label class="labels fw-bold"><i class="fa-solid fa-envelope"></i>
                                Email</label>
                            <p>{{ $datas->pelamar->email }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">

                        @if ($datas->pelamar->alamat == null && $datas->pelamar->tanggal_lahir == null)
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-location-dot"></i> Alamat</label>
                                <p>{{ '-' }}</p>

                            </div>
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-regular fa-calendar-days"></i> Tanggal
                                    Lahir</label>
                                <p>{{ '-' }}</p>
                            </div>
                        @else
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-location-dot"></i> Alamat</label>
                                <p>{{ $datas->pelamar->alamat }}</p>

                            </div>
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-regular fa-calendar-days"></i> Tanggal
                                    Lahir</label>
                                <p>{{ \Carbon\Carbon::parse($datas->pelamar->tanggal_lahir)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y ') }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="row mt-2">
                        @if ($datas->pelamar->kebangsaan == null)
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
                                <p>{{ $datas->pelamar->kebangsaan }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="labels fw-bold"><i class="fa-solid fa-user"></i>
                                    Jenis Kelamin</label>
                                <p>{{ $datas->pelamar->jenis_kelamin }}</p>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="container  rounded mt-4 mb-4">
                    <div class="accordion mt-4 mb-4 col-12" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#tesTertulis" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Test Tertulis
                                </button>

                            </h2>
                            <div id="tesTertulis" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="mt-3 mb-3">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#jadwalTesTertulis">
                                            Buat Jadwal Tes
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="jadwalTesTertulis" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Jadwal Tes
                                                            Tertulis</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/admin-dashboard/lowongan/addScheduleTest"
                                                            method="POST" id="formAddScheduleTest">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="col-9">
                                                                    <div class="mb-3">
                                                                        <label for="tanggal_tes"
                                                                            class="form-label">Tanggal
                                                                            Tes</label>
                                                                        <input type="date" class="form-control"
                                                                            id="tanggal_tes" placeholder="Tanggal Tes"
                                                                            name="tanggal_tes"
                                                                            value="{{ old('tanggal_tes') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="mb-3">
                                                                        <label for="waktu_mulai"
                                                                            class="form-label">Waktu
                                                                            Mulai</label>
                                                                        <input type="time" class="form-control"
                                                                            id="waktu_mulai" placeholder="Waktu Mulai"
                                                                            name="waktu_mulai"
                                                                            value="{{ old('waktu_mulai') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="mb-3">
                                                                        <label for="waktu_selesai"
                                                                            class="form-label">Waktu
                                                                            Selesai</label>
                                                                        <input type="time" class="form-control"
                                                                            id="waktu_selesai"
                                                                            placeholder="Waktu Selesai"
                                                                            name="waktu_selesai"
                                                                            value="{{ old('waktu_selesai') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-9" hidden>
                                                                    <div class="mb-3">
                                                                        <label for="id_pelamar_lowongan"
                                                                            class="form-label">id_pelamar_lowongan</label>
                                                                        <input type="text" class="form-control"
                                                                            id="id_pelamar_lowongan"
                                                                            placeholder="id pelamar lowongan"
                                                                            name="id_pelamar_lowongan">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal"
                                                                    onclick="hapusData()">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-borderless table-responsive">
                                        <thead class="">
                                            <tr>
                                                <th scope="col" class="text-center">No</th>
                                                <th scope="col" class="text-center">Tanggal Tes</th>
                                                <th scope="col" class="text-center">Waktu</th>
                                                <th scope="col">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion mt-4 mb-4 col-12" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#tesWawancara" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Test Wawancara
                                </button>

                            </h2>
                            <div id="tesWawancara" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="mt-3 mb-3">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#jadwalTesWawancara">
                                            Buat Jadwal Tes
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="jadwalTesWawancara" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Jadwal Tes
                                                            Wawancara</h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/admin-dashboard/lowongan/addScheduleTest"
                                                            method="POST" id="formAddScheduleTest">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="col-9">
                                                                    <div class="mb-3">
                                                                        <label for="tanggal_tes"
                                                                            class="form-label">Tanggal
                                                                            Tes</label>
                                                                        <input type="date" class="form-control"
                                                                            id="tanggal_tes" placeholder="Tanggal Tes"
                                                                            name="tanggal_tes"
                                                                            value="{{ old('tanggal_tes') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="mb-3">
                                                                        <label for="waktu_mulai"
                                                                            class="form-label">Waktu
                                                                            Mulai</label>
                                                                        <input type="time" class="form-control"
                                                                            id="waktu_mulai" placeholder="Waktu Mulai"
                                                                            name="waktu_mulai"
                                                                            value="{{ old('waktu_mulai') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="mb-3">
                                                                        <label for="waktu_selesai"
                                                                            class="form-label">Waktu
                                                                            Selesai</label>
                                                                        <input type="time" class="form-control"
                                                                            id="waktu_selesai"
                                                                            placeholder="Waktu Selesai"
                                                                            name="waktu_selesai"
                                                                            value="{{ old('waktu_selesai') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-9" hidden>
                                                                    <div class="mb-3">
                                                                        <label for="id_pelamar_lowongan"
                                                                            class="form-label">id_pelamar_lowongan</label>
                                                                        <input type="text" class="form-control"
                                                                            id="id_pelamar_lowongan"
                                                                            placeholder="id pelamar lowongan"
                                                                            name="id_pelamar_lowongan">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal"
                                                                    onclick="hapusData()">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>

                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-borderless table-responsive">
                                        <thead class="">
                                            <tr>
                                                <th scope="col" class="text-center">No</th>
                                                <th scope="col" class="text-center">Tanggal Tes</th>
                                                <th scope="col" class="text-center">Waktu</th>
                                                <th scope="col">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script> --}}
