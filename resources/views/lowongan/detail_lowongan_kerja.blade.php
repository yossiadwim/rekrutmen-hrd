<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login-style.css">
    <link rel="stylesheet" href="/css/detail-lowongan-style.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>
</head>

<body style="font-family: Poppins">

    @include('partials.navbar')

    @if ($errors->any())
        <div class="container justify-content-center col-8 mt-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}

                        </li>
                    @endforeach

                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="container justify-content-center col-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @auth
        @include('partials.notification_pelamar')
    @endauth
    {{-- 
    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="mx-2 fw-bold text-light">Loading...</div>
    </div>


    <div id="loader" class="loader-wrapper" style="display: none;">
        <div class="loader"></div>
        <div class="mx-2 fw-bold text-light">Loading...</div>
    </div> --}}

    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mt-4">
                <li class="breadcrumb-item"><a href="/lowongan-kerja">Lowongan Kerja</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Lowongan Kerja</li>
            </ol>
        </nav>

        <h2 class="mt-4 fw-bold">{{ $lowongan->nama_lowongan }}</h2>
        <h5 class="mt-4">YAYASAN SATUNAMA</h5>
        <h6 class="mt-4"><i class="fa-solid fa-building" style="color: #000000;"></i></i> Departemen
            {{ $lowongan->departemen->nama_departemen }}
        </h6>
        <h6 class="mt-4"><i class="fa-solid fa-hourglass-half" style="color: #000000;"></i>
            {{ $lowongan->tipe_lowongan }}</h6>
        <h6 class="mt-4"><i class="fa-solid fa-calendar-days" style="color: #000000;"></i> Dibuka sampai dengan,
            {{ \Carbon\Carbon::parse($lowongan->tanggal_tutup)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y ') }}
        </h6>

        <div class="mt-4">
            <!-- Button trigger modal -->
            @if ($pelamarExist != null)
                <button type="button" class="btn btn-danger bg-btn border-0" data-bs-toggle="modal"
                    data-bs-target="#button-lamar" disabled>
                    Anda Sudah Melamar Lowongan Ini
                </button>
            @elseif ($lowongan->tanggal_tutup < now() && !$lowongan->closed)
                <button type="button" class="btn btn-primary bg-btn border-0" data-bs-toggle="modal"
                    data-bs-target="#button-lamar" disabled>
                    Lowongan Sudah Ditutup
                </button>
            @elseif ($pelamarExist == null && !$lowongan->closed)
                <button type="button" class="btn btn-success bg-btn border-0" data-bs-toggle="modal"
                    data-bs-target="#button-lamar">
                    Lamar
                </button>
            @elseif ($lowongan->closed)
                <button type="button" class="btn btn-primary bg-btn border-0" data-bs-toggle="modal"
                    data-bs-target="#button-lamar" disabled>
                    Lowongan Sudah Ditutup
                </button>
            @endif

            @if ($user)
                <!-- Modal -->
                <div class="modal fade" id="button-lamar" tabindex="-1" aria-labelledby="modal-lamar"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modal-lamar">Unggah Dokumen</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            @if (in_array($user->id_pelamar, $arrPengalamanId) && in_array($user->id_pelamar, $arrPendidikanId))
                                <form action="/lowongan-kerja/{{ $lowongan->slug }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class=" mb-3" hidden>
                                            <input type="text" class="form-control mb-4" name="id_pelamar"
                                                id="id_pelamar" value="{{ $user == null ? '' : $user->id_pelamar }}">
                                            <input type="text" class="form-control mb-4" name="nama_pelamar"
                                                id="id_pelamar" value="{{ $user == null ? '' : $user->pelamar->nama_pelamar }}">
                                            <input type="text" class="form-control mb-4" name="id_pelamar"
                                                id="id_pelamar" value="{{ $user == null ? '' : $user->id_pelamar }}">
                                        </div>
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label"><b>Surat Lamaran</b>(<i>format PDF*</i>)
                                                </label>
                                                <input class="form-control" type="file" id="formFile"
                                                    name="surat_lamaran">
                                            </div>
                                            <div class="mb-3 mt-4">
                                                <label for="formFile" class="form-label"><b>Curriculum Vitae/CV </b>(<i>format PDF*</i>)
                                                </label>
                                                <input class="form-control" type="file" id="formFile"
                                                    name="cv">
                                            </div>
                                            <div class="mb-3 mt-4">
                                                <label for="formFile" class="form-label"><b>Ijazah </b>(<i>format PDF*</i>)
                                                </label>
                                                <input class="form-control" type="file" id="formFile"
                                                    name="ijasah">
                                            </div>
                                            {{-- <label for="inputGroupFile01">Surat lamaran, Resume/CV, dan Ijasah
                                                        </label>
                                                    <input type="file"
                                                        class="form-control mt-1 @error('dokumen.*') is-invalid @enderror"
                                                        id="inputGroupFile01" name="dokumen[]" multiple>
                                                    @error('dokumen.*')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror --}}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success"
                                            id="button-unggah">Unggah</button>
                                    </div>
                                </form>
                            @else
                                <div class="modal-body">
                                    <p style="text-align: justify">Lengkapi profil, tentang saya, pengalaman kerja, dan
                                        pendidikan terlebih dahulu pada halaman profil. </p>
                                    <a class="btn btn-primary" href="/profil-kandidat/users/{{ $user->slug }}"
                                        role="button">Ke Halaman Profil</a>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <!-- Modal -->
                <div class="modal fade" id="button-lamar" tabindex="-1" aria-labelledby="modal-lamar"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modal-lamar"><i
                                        class="fa-solid fa-triangle-exclamation" style="color: #f0e800;"></i>
                                    Pemberitahuan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Silahkan untuk melakukan login atau membuat akun telebih dahulu sebelum melamar</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Keluar</button>
                                <a href="/login" class="btn btn-success">Login</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

        </div>

        <div class="mt-5">
            <hr class="border-dark border-3">
        </div>

        <div class="mt-4">
            <article class="justify-content-center text-justify col-9">
                {!! $lowongan->deskripsi !!}
            </article>
        </div>



    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</body>

</html>

<script src="{{ asset('js/detail-lowongan.js') }}">
    // window.addEventListener("load", function() {
    //     const loader = document.querySelector(".loader-wrapper");
    //     const content = document.querySelector(".content");

    //     // Hide the loader
    //     loader.style.display = "none";

    //     // Show the content
    //     content.style.display = "block";
    // });
</script>
