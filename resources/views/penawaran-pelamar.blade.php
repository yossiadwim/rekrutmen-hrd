{{-- @dd($data_penawaran) --}}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>
</head>

<body style="font-family: Poppins">
    @include('partials.navbar')
    @auth
        @include('partials.notification_pelamar')
        <div class="container mt-5">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/profil-kandidat/users/{{ $user->slug }}/lamaran-saya">Lamaran
                            Saya</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Penawaran Pelamar</li>
                </ol>
            </nav>

        </div>

        <div class="container col-6 mt-5">
            @foreach ($datas as $data)
                @if ($data->statusLamaran[0]->status->nama_status == 'penawaran')
                    @if ($data_penawaran[0]->kisaran_gaji != null)
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label for="nama_lowongan" class="fw-bold">Lowongan</label>
                                        <p id="nama_lowongan" class="">{{ $data->lowongan->nama_lowongan }}</p>
                                    </div>
                                    <div class="col">
                                        <label for="nama_lowongan" class="fw-bold">Departemen</label>
                                        <p id="nama_lowongan" class="">Departemen
                                            {{ $data->lowongan->departemen->nama_departemen }}</p>
                                    </div>
                                    <div class="col">
                                        <label for="nama_lowongan" class="fw-bold">Tipe Lowongan</label>
                                        <p id="nama_lowongan" class="">{{ $data->lowongan->tipe_lowongan }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="nama_lowongan" class="fw-bold">Tanggal Melamar</label>
                                        <p id="nama_lowongan" class="">
                                            {{ \Carbon\Carbon::parse($data->pelamar->pelamarLowongan[0]->tanggal_melamar)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y H:i ') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="">
                                    <p>Dengan ini kami menyatakan penawaran terhadap lamaran Anda pada lowongan
                                        <strong>{{ $data->lowongan->nama_lowongan }}</strong> dengan kisaran gaji

                                        @if ($data_penawaran[0]->gaji_final != null)
                                            <s>
                                                <strong>
                                                    Rp
                                                    {{ number_format($data_penawaran[0]->kisaran_gaji, 0, ',', '.') }}.</strong>
                                            </s>
                                            <strong> Rp
                                                {{ number_format($data_penawaran[0]->gaji_final, 0, ',', '.') }}.</strong>
                                        @else
                                            <strong> Rp
                                                {{ number_format($data_penawaran[0]->kisaran_gaji, 0, ',', '.') }}.</strong>
                                        @endif
                                        Apakah Anda bersedia mengambil tawaran ini?
                                    </p>
                                </div>

                                @if ($data_penawaran[0]->status_penawaran == 'negosiasi' && $data_penawaran[0]->gaji_final == null)
                                    <button type="button" class="btn btn-success" value="terima" disabled>Terima</button>
                                    <button type="button" class="btn btn-danger" value="tolak" disabled>Tolak</button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#negosiasi" disabled>
                                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                        <span role="status">Sedang negoisasi...</span>
                                    </button>
                                @elseif ($data_penawaran[0]->status_penawaran == 'negosiasi' && $data_penawaran[0]->gaji_final != null)
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#terima">Terima</button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#tolak">Tolak</button>
                                    <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                                        data-bs-target="#negosiasi"
                                        {{ $data_penawaran[0]->gaji_final != null ? 'hidden' : '' }}>
                                        Nego
                                    </button>
                                @elseif($data_penawaran[0]->status_penawaran == 'terima')
                                    <button class="btn btn-success" disabled>Anda sudah menerima penawaran ini</button>
                                @elseif($data_penawaran[0]->status_penawaran == 'tolak')
                                    <button class="btn btn-danger" disabled>Anda sudah menolak penawaran ini</button>
                                @else
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#terima">Terima</button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#tolak">Tolak</button>
                                    <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                                        data-bs-target="#negosiasi">
                                        Nego
                                    </button>
                                @endif
                                <!--Modal Terima-->
                                <div class="modal fade" id="terima" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Terima Penawaran</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="/admin-dashboard/lowongan/detail-pelamar/beban-kerja/{{ auth()->user()->slug }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    Dengan ini Anda akan menyatakan menerima penawaran untuk lowongan
                                                    <strong>{{ $data->lowongan->nama_lowongan }}
                                                    </strong>
                                                    <input type="text" name="status_penawaran" value="terima" hidden>
                                                    <input type="text" name="kisaran_gaji"
                                                        value="{{ $data_penawaran[0]->kisaran_gaji }}" hidden>
                                                    <input type="text" name="gaji_final"
                                                        value="{{ $data_penawaran[0]->gaji_final }}" hidden>
                                                    <input type="text" name="id_lowongan" value="{{ $lowongan->id }}"
                                                        hidden>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Terima</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!--Modal Tolak-->
                                <div class="modal fade" id="tolak" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Penawaran</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="/admin-dashboard/lowongan/detail-pelamar/beban-kerja/{{ auth()->user()->slug }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    Anda menyatakan untuk menolak penawaran untuk lowongan
                                                    <strong>{{ $data->lowongan->nama_lowongan }}
                                                    </strong>
                                                    <input type="text" name="status_penawaran" value="tolak" hidden>
                                                    <input type="text" name="kisaran_gaji"
                                                        value="{{ $data_penawaran[0]->kisaran_gaji }}" hidden>
                                                    <input type="text" name="gaji_final"
                                                        value="{{ $data_penawaran[0]->gaji_final }}" hidden>
                                                    <input type="text" name="id_lowongan" value="{{ $lowongan->id }}"
                                                        hidden>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Terima</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Negosiasi-->
                                <div class="modal fade" id="negosiasi" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Negosiasi Gaji</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="/admin-dashboard/lowongan/detail-pelamar/beban-kerja/{{ auth()->user()->slug }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    Dengan ini Anda akan menyatakan untuk melakukan negosiasi gaji terhadap
                                                    penawaran lowongan <strong>{{ $data->lowongan->nama_lowongan }}
                                                    </strong>
                                                    <input type="text" name="status_penawaran" value="negosiasi"
                                                        hidden>
                                                    <input type="text" name="kisaran_gaji"
                                                        value="{{ $data_penawaran[0]->kisaran_gaji }}" hidden>
                                                    <input type="text" name="id_lowongan" value="{{ $lowongan->id }}"
                                                        hidden>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Ajukan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <h4 class="fw-bold text-center">HRD belum mengirimkan penawaran kepada Anda</h4>
                    @endif
                @endif
            @endforeach
        </div>

    @endauth

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
