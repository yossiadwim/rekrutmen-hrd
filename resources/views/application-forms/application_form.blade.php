{{-- @dd($datas) --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main-style.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/application_form.js') }}"></script>
</head>

<body style="font-family: Poppins;">

    @auth
        @include('partials.navbar')

        @include('partials.notification_pelamar')

        @if (session()->has('failed send application form'))
            <div class="container justify-content-center col-8">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center">
                    {{ session('failed send application form') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="container mt-5 mb-3">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h3 class="fw-bold">Application Form - Data Pribadi</h3>
        </div>


        @foreach ($datas as $data)
            @if ($data->lowongan->slug == $lowongan->slug)
                <form action="/{{ $lowongan->slug }}/application-form/data-pribadi" method="POST">
                    @csrf
                    <div class="container mb-5 border">
                        <input type="text" name="id_pelamar_lowongan" value="{{ $data->id_pelamar_lowongan }}" hidden>
                        <input type="text" name="slug_lowongan" value="{{ $data->lowongan->slug }}" hidden>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Posisi yang dilamar</p>
                            </div>
                            <div class="col-6">
                                <div class="form-floating ">
                                    <input type="text"
                                        class="form-control @if ($data->lowongan->nama_lowongan != null) is-valid @endif"
                                        name="posisi_lowongan" id="nama_lowongan" placeholder="Posisi yang dilamar"
                                        value="{{ $data->lowongan->nama_lowongan }}" disabled>
                                    <label for="floatingInput">Posisi yang dilamar</label>

                                </div>
                            </div>

                        </div>
                        <div class="row mt-5 ">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Nama Pelamar</p>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control is-valid " id="nama_pelamar"
                                        name="nama_pelamar" placeholder="Nama Pelamar"
                                        value="{{ $data->pelamar->nama_pelamar }}" oninput="checkNullValue()" required>
                                    <label for="nama_pelamar">Nama Pelamar</label>
                                    <div class="invalid-feedback" id="validation_nama_pelamar">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5 ">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Nomor Identitas/NIK</p>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control  @if ($data->pelamar->nik == null) is-invalid
                        @else
                            is-valid @endif"
                                        id="nik" name="nik" placeholder="Nomor Identitas" maxlength="16"
                                        oninput="validationNik()" value="{{ old('nik', $data->pelamar->nik) }}">
                                    <label for="nik"></label>
                                    <div class="invalid-feedback" id="validation_nik">Wajib Diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5 ">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Gaji yang diharapkan</p>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control currency  @if ($data->pelamar->ekspetasi_gaji == null) is-invalid
                        @else
                            is-valid @endif"
                                        id="gaji" placeholder="Gaji yang diharapkan" name="ekspetasi_gaji"
                                        oninput="formatCurrency(this)" value="@currency($data->pelamar->ekspetasi_gaji)">

                                    <label for="gaji"></label>
                                    <div class="invalid-feedback" id="validation-gaji">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Alamat</p>
                            </div>
                            <div class=" col-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control {{ $data->pelamar->alamat == null ? 'is-invalid' : 'is-valid' }}"
                                        id="alamat" placeholder="Alamat" name="alamat"
                                        value="{{ $data->pelamar->alamat == null ? '' : $data->pelamar->alamat }}"
                                        oninput="checkNullValue()">
                                    <label for="alamat"></label>
                                    <div class="invalid-feedback" id="validation-alamat">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Alamat Tetap</p>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control {{ $data->pelamar->alamat_tetap == null ? 'is-invalid' : 'is-valid' }}"
                                        id="alamat_tetap" name="alamat_tetap" placeholder="Alamat"
                                        value="{{ old('alamat_tetap', $data->pelamar->alamat_tetap) }}">
                                </div>
                                <div class="invalid-feedback" id="validation-alamat-tetap">
                                    Wajib Diisi
                                </div>

                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Telepon Rumah</p>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control is-valid" id="telepon_rumah"
                                        name="telepon_rumah" placeholder="Telepon Rumah"
                                        value="{{ $data->pelamar->telepon_rumah }}" maxlength="12"
                                        oninput="checkNullValue()">
                                    <label for="telepon_rumah"></label>
                                    <div class="invalid-feedback" id="validation_telepon_rumah">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Telepon Kantor</p>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @if ($data->pelamar->telepon_kantor == null) is-invalid
                            @else
                                is-valid @endif"
                                        id="telepon_kantor" name="telepon_kantor" placeholder="Telepon Kantor"
                                        value="{{ old('telepon_kantor', $data->pelamar->telepon_kantor) }}"
                                        maxlength="12" oninput="checkNullValue()">
                                    <label for="telepon_kantor">Telepon Kantor</label>
                                    <div class="invalid-feedback" id="validation_telepon_kantor">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Jenis Kelamin</p>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <select class="form-select is-valid" id="jenis_kelamin" name="jenis_kelamin"
                                        aria-label="Floating label select example">
                                        <option value="" disabled>Pilih</option>
                                        @if (old('jenis_kelamin', $data->pelamar->jenis_kelamin) == 'laki-laki')
                                            <option value="laki-laki" selected>Laki-laki</option>
                                        @elseif(old('jenis_kelamin', $data->pelamar->jenis_kelamin) == 'perempuan')
                                            <option value="perempuan" selected>Perempuan</option>
                                        @else
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        @endif

                                    </select>
                                    <label for="floatingSelect">Jenis Kelamin</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Suku/Keturunan</p>
                            </div>
                            <div class=" col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="suku" name="suku"
                                        placeholder="suku" value="{{ old('suku', $data->pelamar->suku) }}">
                                    <label for="suku">Suku/Keturunan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Kebangsaan/Warga Negara</p>
                            </div>

                            <div class=" col-6">
                                <div class="form-floating">
                                    <select class="form-select selectpicker is-valid" data-live-search="true"
                                        data-show-subtext="true" id="kebangsaan" name="kebangsaan"
                                        aria-label="Floating label select example">
                                        @foreach ($countries as $country)
                                            @if (old('kebangsaan', $country) == $data->pelamar->kebangsaan)
                                                <option value="{{ $data->pelamar->kebangsaan }}" selected>
                                                    {{ $data->pelamar->kebangsaan }}
                                                </option>
                                            @else
                                                <option value="{{ $country }}">{{ $country }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                    <label for="kebangsaan">Kewarganegaraan</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Agama</p>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <select
                                        class="form-select @if ($data->pelamar->id_agama == null) is-invalid
                            @else
                                is-valid @endif"
                                        id="id_agama" name="id_agama" aria-label="Floating label select example"
                                        oninput="checkNullSelectOption()">
                                        <option value="" selected disabled>Pilih</option>
                                        @foreach ($religions as $religion)
                                            @if (old('id_agama', $religion->id_agama) == $data->pelamar->id_agama)
                                                <option value="{{ $religion->id_agama }}" selected>
                                                    {{ $religion->nama_agama }}
                                                </option>
                                            @else
                                                <option value="{{ $religion->id_agama }}">
                                                    {{ $religion->nama_agama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="agama">Agama</label>
                                    <div class="invalid-feedback" id="validation_agama">
                                        Pilih Salah Satu
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Tempat Lahir</p>
                            </div>
                            <div class=" col-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control 
                            @if ($data->pelamar->tempat_lahir == null) is-invalid
                            @else
                                is-valid @endif
                            "
                                        id="tempat_lahir" name="tempat_lahir" placeholder="tempat_lahir"
                                        value="{{ old('tempat_lahir', $data->pelamar->tempat_lahir) == null ? '' : old('tempat_lahir', $data->pelamar->tempat_lahir) }}"
                                        oninput="checkNullValue()">
                                    <label for="tempat_lahir"></label>
                                    <div class="invalid-feedback" id="validation_tempat_lahir">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Tanggal Lahir</p>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <input type="date" class="form-control is-valid" id="tanggal_lahir"
                                        name="tanggal_lahir" placeholder="Tanggal Lahir"
                                        value="{{ $data->pelamar->tanggal_lahir }}">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Tinggi Badan</p>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control 
                                    {{ $data->pelamar->tinggi_badan == null ? 'is-invalid' : 'is-valid' }}"
                                        id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan"
                                        value="{{ old('tinggi_badan', $data->pelamar->tinggi_badan) == null ? '' : old('tinggi_badan', $data->pelamar->tinggi_badan) }}"
                                        maxlength="3" oninput="checkNullValue()">
                                    <label for="tinggi_badan">Satuan centimeter (cm)</label>
                                    @if ($data->pelamar->tinggi_badan == null)
                                        <div class="invalid-feedback" id="validation_tinggi badan">
                                            Wajib Diisi
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Berat Badan</p>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control {{ $data->pelamar->berat_badan == null ? 'is-invalid' : 'is-valid' }}"
                                        id="berat_badan" name="berat_badan" maxlength="3" placeholder="Berat Badan"
                                        value="{{ old('berat_badan', $data->pelamar->berat_badan) == null ? '' : old('berat_badan', $data->pelamar->berat_badan) }}"
                                        oninput="checkNullValue()">
                                    <label for="berat_badan">Satuan kilogram (kg)</label>
                                    @if ($data->pelamar->berat_badan == null)
                                        <div class="invalid-feedback" id="validation_berat badan">
                                            Wajib Diisi
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Status Kawin</p>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <select class="form-select is-invalid" id="status_kawin" name="status_kawin"
                                        aria-label="Floating label select example" oninput="checkNullValue()">
                                        <option selected disabled>Pilih</option>
                                        <option value="belum_kawin">Belum Kawin</option>
                                        <option value="kawin">Kawin</option>
                                        <option value="cerai_hidup">Cerai Hidup</option>
                                        <option value="cerai_mati">Cerai Mati</option>
                                    </select>
                                    <label for="status_kawin">Status Kawin</label>
                                    <div class="invalid-feedback" id="validation_status_kawin">
                                        Pilih Salah Satu
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-5 mb-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Nama Suami/Istri</p>
                            </div>
                            <div class=" col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control " id="nama_pasangan" name="nama_pasangan"
                                        placeholder="Nama Suami/Istri" value="" oninput="checkNullValue()">
                                    <label for="nama_pasangan">Nama Suami/Istri</label>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <p>Hobi</p>
                            </div>
                            <div class="col-6">
                                <div class="input-group" id="">
                                    <textarea class="form-control" placeholder="Masukkan hobi Anda" id="hobi" name="hobi[]"></textarea>
                                </div>
                                <label for="hobi" class="opacity-50 mx-1" style="font-size: 14px">Jika lebih dari
                                    satu, pisahkan
                                    dengan koma (",")</label>
                            </div>
                        </div>

                        <div class="mb-5">
                            <button type="submit" class="btn btn-primary">Selanjutnya</button>
                        </div>
                    </div>

                    {{-- <div class="container mt-5 mb-5">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#data_pribadi" aria-expanded="true" aria-controls="data_pribadi">
                                        Data Pribadi
                                    </button>
                                </h2>
                                <div id="data_pribadi" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="mt-4 mx-2">
                                            <h3 class="fw-bold">Data Pribadi</h3>
                                        </div>

                                        <input type="text" name="id_pelamar_lowongan"
                                            value="{{ $data->id_pelamar_lowongan }}" hidden>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Posisi yang dilamar</p>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating ">
                                                    <input type="text"
                                                        class="form-control @if ($data->lowongan->nama_lowongan != null) is-valid @endif"
                                                        name="posisi_lowongan" id="nama_lowongan"
                                                        placeholder="Posisi yang dilamar"
                                                        value="{{ $data->lowongan->nama_lowongan }}" disabled>
                                                    <label for="floatingInput">Posisi yang dilamar</label>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mt-5 ">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Nama Pelamar</p>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control is-valid "
                                                        id="nama_pelamar" name="nama_pelamar" placeholder="Nama Pelamar"
                                                        value="{{ $data->pelamar->nama_pelamar }}"
                                                        oninput="checkNullValue()" required>
                                                    <label for="nama_pelamar">Nama Pelamar</label>
                                                    <div class="invalid-feedback" id="validation_nama_pelamar">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-5 ">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Nomor Identitas/NIK</p>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control  @if ($data->pelamar->nik == null) is-invalid
                                            @else
                                                is-valid @endif"
                                                        id="nik" name="nik" placeholder="Nomor Identitas"
                                                        maxlength="16" oninput="validationNik()"
                                                        value="{{ old('nik', $data->pelamar->nik) }}">
                                                    <label for="nik"></label>
                                                    <div class="invalid-feedback" id="validation_nik">Wajib Diisi</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-5 ">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Gaji yang diharapkan</p>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control currency  @if ($data->pelamar->ekspetasi_gaji == null) is-invalid
                                            @else
                                                is-valid @endif"
                                                        id="gaji" placeholder="Gaji yang diharapkan"
                                                        name="ekspetasi_gaji" oninput="formatCurrency(this)"
                                                        value="@currency($data->pelamar->ekspetasi_gaji)">

                                                    <label for="gaji"></label>
                                                    <div class="invalid-feedback" id="validation-gaji">
                                                        Wajib Diisi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Alamat</p>
                                            </div>
                                            <div class=" col-6">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control {{ $data->pelamar->alamat == null ? 'is-invalid' : 'is-valid' }}"
                                                        id="alamat" placeholder="Alamat" name="alamat"
                                                        value="{{ $data->pelamar->alamat == null ? '' : $data->pelamar->alamat }}"
                                                        oninput="checkNullValue()">
                                                    <label for="alamat"></label>
                                                    <div class="invalid-feedback" id="validation-alamat">
                                                        Wajib Diisi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Alamat Tetap</p>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control {{ $data->pelamar->alamat_tetap == null ? 'is-invalid' : 'is-valid' }}"
                                                        id="alamat_tetap" name="alamat_tetap" placeholder="Alamat"
                                                        value="{{ old('alamat_tetap', $data->pelamar->alamat_tetap) }}">
                                                </div>
                                                <div class="invalid-feedback" id="validation-alamat-tetap">
                                                    Wajib Diisi
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Telepon Rumah</p>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control is-valid"
                                                        id="telepon_rumah" name="telepon_rumah"
                                                        placeholder="Telepon Rumah"
                                                        value="{{ $data->pelamar->telepon_rumah }}" maxlength="12"
                                                        oninput="checkNullValue()">
                                                    <label for="telepon_rumah"></label>
                                                    <div class="invalid-feedback" id="validation_telepon_rumah">
                                                        Wajib Diisi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Telepon Kantor</p>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control @if ($data->pelamar->telepon_kantor == null) is-invalid
                                                @else
                                                    is-valid @endif"
                                                        id="telepon_kantor" name="telepon_kantor"
                                                        placeholder="Telepon Kantor"
                                                        value="{{ old('telepon_kantor', $data->pelamar->telepon_kantor) }}"
                                                        maxlength="12" oninput="checkNullValue()">
                                                    <label for="telepon_kantor">Telepon Kantor</label>
                                                    <div class="invalid-feedback" id="validation_telepon_kantor">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Jenis Kelamin</p>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating">
                                                    <select class="form-select is-valid" id="jenis_kelamin"
                                                        name="jenis_kelamin" aria-label="Floating label select example">
                                                        <option value="" disabled>Pilih</option>
                                                        @if (old('jenis_kelamin', $data->pelamar->jenis_kelamin) == 'laki-laki')
                                                            <option value="laki-laki" selected>Laki-laki</option>
                                                        @elseif(old('jenis_kelamin', $data->pelamar->jenis_kelamin) == 'perempuan')
                                                            <option value="perempuan" selected>Perempuan</option>
                                                        @else
                                                            <option value="Pria">Pria</option>
                                                            <option value="Wanita">Wanita</option>
                                                        @endif

                                                    </select>
                                                    <label for="floatingSelect">Jenis Kelamin</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Suku/Keturunan</p>
                                            </div>
                                            <div class=" col-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="suku"
                                                        name="suku" placeholder="suku"
                                                        value="{{ old('suku', $data->pelamar->suku) }}">
                                                    <label for="suku">Suku/Keturunan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Kebangsaan/Warga Negara</p>
                                            </div>

                                            <div class=" col-6">
                                                <div class="form-floating">
                                                    <select class="form-select selectpicker is-valid"
                                                        data-live-search="true" data-show-subtext="true" id="kebangsaan"
                                                        name="kebangsaan" aria-label="Floating label select example">
                                                        @foreach ($countries as $country)
                                                            @if (old('kebangsaan', $country) == $data->pelamar->kebangsaan)
                                                                <option value="{{ $data->pelamar->kebangsaan }}" selected>
                                                                    {{ $data->pelamar->kebangsaan }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $country }}">{{ $country }}
                                                                </option>
                                                            @endif
                                                        @endforeach

                                                    </select>
                                                    <label for="kebangsaan">Kewarganegaraan</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Agama</p>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating">
                                                    <select
                                                        class="form-select @if ($data->pelamar->id_agama == null) is-invalid
                                                @else
                                                    is-valid @endif"
                                                        id="id_agama" name="id_agama"
                                                        aria-label="Floating label select example"
                                                        oninput="checkNullSelectOption()">
                                                        <option value="" selected disabled>Pilih</option>
                                                        @foreach ($religions as $religion)
                                                            @if (old('id_agama', $religion->id_agama) == $data->pelamar->id_agama)
                                                                <option value="{{ $religion->id_agama }}" selected>
                                                                    {{ $religion->nama_agama }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $religion->id_agama }}">
                                                                    {{ $religion->nama_agama }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <label for="agama">Agama</label>
                                                    <div class="invalid-feedback" id="validation_agama">
                                                        Pilih Salah Satu
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Tempat Lahir</p>
                                            </div>
                                            <div class=" col-6">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control 
                                                @if ($data->pelamar->tempat_lahir == null) is-invalid
                                                @else
                                                    is-valid @endif
                                                "
                                                        id="tempat_lahir" name="tempat_lahir" placeholder="tempat_lahir"
                                                        value="{{ old('tempat_lahir', $data->pelamar->tempat_lahir) == null ? '' : old('tempat_lahir', $data->pelamar->tempat_lahir) }}"
                                                        oninput="checkNullValue()">
                                                    <label for="tempat_lahir"></label>
                                                    <div class="invalid-feedback" id="validation_tempat_lahir">
                                                        Wajib Diisi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Tanggal Lahir</p>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control is-valid"
                                                        id="tanggal_lahir" name="tanggal_lahir"
                                                        placeholder="Tanggal Lahir"
                                                        value="{{ $data->pelamar->tanggal_lahir }}">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Tinggi Badan</p>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control 
                                                        {{ $data->pelamar->tinggi_badan == null ? 'is-invalid' : 'is-valid' }}"
                                                        id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan"
                                                        value="{{ old('tinggi_badan', $data->pelamar->tinggi_badan) == null ? '' : old('tinggi_badan', $data->pelamar->tinggi_badan) }}"
                                                        maxlength="3" oninput="checkNullValue()">
                                                    <label for="tinggi_badan">Satuan centimeter (cm)</label>
                                                    @if ($data->pelamar->tinggi_badan == null)
                                                        <div class="invalid-feedback" id="validation_tinggi badan">
                                                            Wajib Diisi
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Berat Badan</p>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control {{ $data->pelamar->berat_badan == null ? 'is-invalid' : 'is-valid' }}"
                                                        id="berat_badan" name="berat_badan" maxlength="3"
                                                        placeholder="Berat Badan"
                                                        value="{{ old('berat_badan', $data->pelamar->berat_badan) == null ? '' : old('berat_badan', $data->pelamar->berat_badan) }}"
                                                        oninput="checkNullValue()">
                                                    <label for="berat_badan">Satuan kilogram (kg)</label>
                                                    @if ($data->pelamar->berat_badan == null)
                                                        <div class="invalid-feedback" id="validation_berat badan">
                                                            Wajib Diisi
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Status Kawin</p>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating">
                                                    <select class="form-select is-invalid" id="status_kawin"
                                                        name="status_kawin" aria-label="Floating label select example"
                                                        oninput="checkNullValue()">
                                                        <option selected disabled>Pilih</option>
                                                        <option value="belum_kawin">Belum Kawin</option>
                                                        <option value="kawin">Kawin</option>
                                                        <option value="cerai_hidup">Cerai Hidup</option>
                                                        <option value="cerai_mati">Cerai Mati</option>
                                                    </select>
                                                    <label for="status_kawin">Status Kawin</label>
                                                    <div class="invalid-feedback" id="validation_status_kawin">
                                                        Pilih Salah Satu
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mt-5 mb-5">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <p>Nama Suami/Istri</p>
                                            </div>
                                            <div class=" col-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control " id="nama_pasangan"
                                                        name="nama_pasangan" placeholder="Nama Suami/Istri"
                                                        value="" oninput="checkNullValue()">
                                                    <label for="nama_pasangan">Nama Suami/Istri</label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_anak" aria-expanded="false"
                                        aria-controls="data_anak">
                                        Data Anak 
                                    </button>
                                </h2>
                                <div id="data_anak" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-4 mx-2">
                                            <h3 class="fw-bold">Data Anak</h3>
                                        </div>
                                        <div class=" mt-5 mb-5">
                                            <div class="">
                                                @include('application-forms.tambah-anak')
                                                <input type="number" class="form-control" id="counter_row_anak"
                                                    name="counter_row_anak" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_keluarga" aria-expanded="false"
                                        aria-controls="data_keluarga">
                                        Data Keluarga
                                    </button>
                                </h2>
                                <div id="data_keluarga" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class=" mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Data Keluarga</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.tambah-anggota-keluarga')
                                                <input type="number" class="form-control" id="counter_row_keluarga"
                                                    name="counter_row_keluarga" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_hobi" aria-expanded="false"
                                        aria-controls="data_hobi">
                                        Data Hobi
                                    </button>
                                </h2>
                                <div id="data_hobi" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class=" mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Hobi</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.hobi')

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_organisasi" aria-expanded="false"
                                        aria-controls="data_organisasi">
                                        Data Pengalaman Organsisasi
                                    </button>
                                </h2>
                                <div id="data_organisasi" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Pengalaman Organisasi</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.tambah-organisasi')
                                                <input type="number" class="form-control" id="counter_row_organisasi"
                                                    name="counter_row_organisasi" placeholder="" hidden>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_kontak_darurat"
                                        aria-expanded="false" aria-controls="data_kontak_darurat">
                                        Data Kontak Darurat
                                    </button>
                                </h2>
                                <div id="data_kontak_darurat" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Emergency Contact/Kontak Darurat</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.kontak_darurat')
                                                <input type="number" class="form-control"
                                                    id="counter_row_kontak_darurat" name="counter_row_kontak_darurat"
                                                    placeholder="" hidden>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_kesehatan" aria-expanded="false"
                                        aria-controls="data_kesehatan">
                                        Data Kondisi Kesehatan
                                    </button>
                                </h2>
                                <div id="data_kesehatan" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Health Condition/Kondisi Kesehatan</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.kesehatan')
                                                <input type="number" class="form-control"
                                                    id="counter_row_kondisi_kesehatan"
                                                    name="counter_row_kondisi_kesehatan" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_riwayat_pendidikan"
                                        aria-expanded="false" aria-controls="data_riwayat_pendidikan">
                                        Data Riwayat Pendidikan
                                    </button>
                                </h2>
                                <div id="data_riwayat_pendidikan" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Education/Riwayat Pendidikan</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.riwayat_pendidikan')
                                                <input type="number" class="form-control"
                                                    id="counter_row_riwayat_pendidikan"
                                                    name="counter_row_riwayat_pendidikan" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_kemampuan_komputer"
                                        aria-expanded="false" aria-controls="data_kemampuan_komputer">
                                        Data Kemampuan Komputer
                                    </button>
                                </h2>
                                <div id="data_kemampuan_komputer" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Computer Skill/Kemampuan Komputer</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.keahlian_komputer')
                                                <input type="number" class="form-control"
                                                    id="counter_row_keahlian_komputer"
                                                    name="counter_row_keahlian_komputer" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_penguasaan_bahasa"
                                        aria-expanded="false" aria-controls="data_penguasaan_bahasa">
                                        Data Penguasaan Bahasa
                                    </button>
                                </h2>
                                <div id="data_penguasaan_bahasa" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Proeficiency Language/Penguasaan Bahasa</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.penguasaan_bahasa')
                                                <input type="number" class="form-control"
                                                    id="counter_row_penguasaan_bahasa"
                                                    name="counter_row_penguasaan_bahasa" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_riwayat_pekerjaan"
                                        aria-expanded="false" aria-controls="data_riwayat_pekerjaan">
                                        Data Riwayat Pekerjaan
                                    </button>
                                </h2>
                                <div id="data_riwayat_pekerjaan" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Work Experience/Pengalaman Kerja</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.riwayat_pekerjaan')
                                                <input type="number" class="form-control"
                                                    id="counter_row_riwayat_pekerjaan"
                                                    name="counter_row_riwayat_pekerjaan" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_referensi" aria-expanded="false"
                                        aria-controls="data_referensi">
                                        Data Referensi
                                    </button>
                                </h2>
                                <div id="data_referensi" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Reference/Referensi</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.referensis')
                                                <input type="number" class="form-control" id="counter_row_referensi"
                                                    name="counter_row_referensi" placeholder="" hidden>
                                                <input type="number" class="form-control"
                                                    id="counter_row_referensi_from_satunama"
                                                    name="counter_row_referensi_from_satunama" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#data_pelatihan" aria-expanded="false"
                                        aria-controls="data_pelatihan">
                                        Data Pelatihan Yang Pernah Diikuti
                                    </button>
                                </h2>
                                <div id="data_pelatihan" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="mt-5 mb-5">
                                            <div class="mt-4 mb-4 mx-2">
                                                <h3 class="fw-bold">Training Followed/Pelatihan Yang Pernah Diikuti</h3>
                                            </div>
                                            <div class="">
                                                @include('application-forms.pelatihan_form')
                                                <input type="number" class="form-control" id="counter_row_pelatihan"
                                                    name="counter_row_pelatihan" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row  d-flex justify-content-center">
                            <div class="col-1 text-end"><input class="form-check-input " type="checkbox" value=""
                                    id="checkbox-pernyataan" onclick="declarationCheck()"></div>
                            <div class="col-6">

                                <label class="form-check-label" for="flexCheckDefault" style="text-align: justify">
                                    I hereby certify that the above information given by me is true to the best
                                    of
                                    my
                                    knowledge
                                    and
                                    understand that any false information contained in the above application may
                                    result
                                    in my
                                    immediate dismissal from the position gained at SATUNAMA Foundation.
                                    <br><br>

                                    <i> Saya menyatakan bahwa keterangan tersebut diatas adalah benar dan
                                        apabila
                                        ada
                                        keterangan
                                        yang
                                        tidak benar saya bersedia dikeluarkan dari posisi yang saya dapatkan di
                                        Yayasan
                                        SATUNAMA.</i>

                                </label>

                            </div>
                        </div>

                    </div>

                    <!-- Button trigger modal -->
                    <div class="container mt-5 mb-5 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary col-5 " id="submit-pernyataan" disabled>
                            Kirim
                        </button>
                    </div> --}}


                </form>
            @endif
        @endforeach
    @else
        login dulu
    @endauth


    <div id="loader" class="loader-wrapper" style="display: none;">
        <div class="loader"></div>
        <div class="mx-2 fw-bold text-light">Loading...</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/application_form.js') }}"></script>
</body>

</html>

<script></script>
