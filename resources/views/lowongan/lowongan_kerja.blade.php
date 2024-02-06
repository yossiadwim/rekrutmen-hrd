{{-- @dd(count($lowonganClosed)) --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">

</head>

<body style="font-family: Poppins;">

    @include('partials.navbar')

    @auth
        @include('partials.notification_pelamar')
    @endauth

    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="mx-2 fw-bold text-light">Loading...</div>
    </div>

    <div id="loader" class="loader-wrapper" style="display: none;">
        <div class="loader"></div>
        <div class="mx-2 fw-bold text-light">Loading...</div>
    </div>
    @if (session()->has('session timeout'))
        <div class="container justify-content-center mt-3 col-8">
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="text-align: center">
                {{ session('session timeout') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <h1 class="mt-4 fs-1 fw-bold" style="text-align:center;">Lowongan Pekerjaan</h1>

    <form action="/lowongan-kerja">
        <div class="container mt-5 col-4">

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari lowongan..." name="search">
                <button class="btn btn-success" type="submit" id="search">Cari</button>
            </div>

        </div>
    </form>

    <div class="container mt-5">
        <form action="/lowongan-kerja">
            <div class="row d-flex justify-content-center border shadow-sm p-3 mb-5 bg-body-tertiary rounded"
                style="background-color: #ffffff">
                <div class="col-2 mb-2 mt-2">
                    <input type="date" class="form-control btn btn-light" id="floatingInput" name="tanggal"
                        style="background: transparent">
                </div>
                <div class="col-2 mb-2 mt-2">
                    <select class="form-select btn btn-light text-start" aria-label="Default select example"
                        name="tipe_lowongan" style="background-color: #ffffff">
                        <option selected disabled>Tipe Lowongan</option>
                        <option value="Magang">Magang</option>
                        <option value="Kontrak">Kontrak</option>
                        <option value="Tetap">Tetap</option>
                    </select>
                </div>
                <div class="col-2 mb-2 mt-2">
                    <select class="form-select btn btn-light text-start" aria-label="Default select example"
                        name="kode_departemen" style="background-color: #ffffff">
                        <option selected disabled>Departemen</option>
                        @foreach ($departemens as $departemen)
                            <option value="{{ $departemen->kode_departemen }}">{{ $departemen->nama_departemen }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 mb-2 mt-2">
                    <button type="submit" class="btn btn-success" id="filter">Filter</button>
                </div>
            </div>
        </form>

    </div>


    @if (count($lowongans) > 0)
        <div class="container mt-5">
            <div class="card card-container mt-4 border">
                <h4 class="fw-bold">Lowongan yang masih dibuka</h4>
                <div class="row mt-4 ">
                    @if (count($lowonganOpen) == 0)
                        <div class="d-flex justify-content-center">
                            <img class="" src="{{ asset('img/no-data.png') }}" alt="" height="350"
                                width="400" style="justify-content: center">
                        </div>
                        <div>
                            <p class="fs-5 text-center">Tidak Ada Lowongan</p>
                        </div>
                    @else
                        @foreach ($lowonganOpen as $job)
                            <div class="col-md-4 mb-5">
                                <div class="card bg-card shadow-sm border border-2">
                                    <a href="/lowongan-kerja/{{ $job->slug }}/detail"
                                        class="text-decoration-none text-dark">
                                        <div class="card-body">
                                            <p class="card-text fw-bold fs-6" style="color: #008800"><i
                                                    class="bi bi-briefcase-fill"></i>
                                                {{ $job->nama_lowongan }}
                                            </p>
                                            <p class="card-text"><i class="bi bi-building-fill"></i> Departemen
                                                {{ $job->nama_departemen }}</p>
                                            <p class="card-text"><i class="fa-solid fa-hourglass-half"
                                                    style="color: #000000;"></i>
                                                {{ $job->tipe_lowongan }}
                                            </p>
                                            <br>
                                            <p class="card-text" style="font-size: 14px; color: #63686E"><i
                                                    class="bi bi-clock"></i> Dibuka pada
                                                {{ \Carbon\Carbon::parse($job->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y ') }}
                                                ,
                                                {{ $job->created_at->diffForHumans() }}</p>
                                            <p class="card-text"></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="card card-container mt-4 border">
                <h4 class="fw-bold">Lowongan yang sudah ditutup</h4>
                <div class="row mt-4 ">
                    @if (count($lowonganClosed) == null)
                        <div class="d-flex justify-content-center">
                            <img class="" src="{{ asset('img/no-data.png') }}" alt="" height="350"
                                width="400" style="justify-content: center">
                        </div>
                        <div>
                            <p class="fs-5 text-center">Tidak Ada Lowongan</p>
                        </div>
                    @else
                        @foreach ($lowonganClosed as $job)
                            <div class="col-md-4 mb-5">
                                <div class="card bg-card shadow-sm border border-2">
                                    <a href="/lowongan-kerja/{{ $job->slug }}/detail"
                                        class="text-decoration-none text-dark">
                                        <div class="card-body">
                                            <p class="card-text fw-bold fs-6" style="color: #008800"><i
                                                    class="bi bi-briefcase-fill"></i>
                                                {{ $job->nama_lowongan }}
                                            </p>
                                            <p class="card-text"><i class="bi bi-building-fill"></i> Departemen
                                                {{ $job->nama_departemen }}</p>
                                            <p class="card-text"><i class="fa-solid fa-hourglass-half"
                                                    style="color: #000000;"></i>
                                                {{ $job->tipe_lowongan }}
                                            </p>
                                            <br>
                                            <p class="card-text" style="font-size: 14px; color: #63686E"><i
                                                    class="bi bi-clock"></i> Ditutup pada
                                                {{ \Carbon\Carbon::parse($job->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y ') }}
                                                ,
                                                {{ $job->created_at->diffForHumans() }}</p>
                                            <p class="card-text"></p>
                                        </div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @elseif (count($lowongans) == 0)
        <div class="d-flex justify-content-center">
            <img class="" src="{{ asset('img/no-data.png') }}" alt="" height="350" width="400"
                style="justify-content: center">
        </div>
        <div>
            <p class="fs-5 text-center">Tidak Ada Lowongan</p>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>

<script src="{{ asset('js/lowongan.js') }}"></script>


<script>
    window.addEventListener("load", function() {
        const loader = document.querySelector(".loader-wrapper");
        const content = document.querySelector(".content");

        // Hide the loader
        loader.style.display = "none";
    });

    @if (Session::has('session_timeout'))
        toastr.success("{{ Session::get('success') }}")
        toastr.options.timeOut = 30; // How long the toast will display without user interaction
        toastr.options.extendedTimeOut = 60;
    @endif
</script>
