<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>

</head>

<body style="font-family: Poppins; background-color:#f6fff6">
    @include('partials.navbar')


    <div class="container mt-4">
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/lowongan-kerja">Lowongan Kerja</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lowongan Departemen
                    {{ $departemen->nama_departemen }}</li>
            </ol>
        </nav>
        <h1 class="mt-4 fs-1 fw-bold">Departemen {{ $departemen->nama_departemen }}</h1>
        @if (count($lowongans) != 0)
            <div class="row">
                @foreach ($lowongans as $lowongan)
                    <div class="card bg-card col-4 mx-3 shadow-sm border mt-3 mb-3">
                        <a href="/lowongan-kerja/{{ $lowongan->slug }}/detail" class="text-decoration-none text-dark">
                            <div class="card-body">
                                <p class="card-text fw-bold fs-5" style="color: #379237"><i
                                        class="bi bi-briefcase-fill"></i>
                                    {{ $lowongan->nama_lowongan }}
                                </p>
                                <p class="card-text"><i class="bi bi-building-fill"></i> Departemen
                                    {{ $lowongan->departemen->nama_departemen }}</p>
                                <p class="card-text"><i class="bi bi-person-fill"></i> {{ $lowongan->tipe_lowongan }}
                                </p>
                                <br>
                                <p class="card-text" style="font-size: 14px; color: #63686E"><i class="bi bi-clock"></i>
                                    Dibuka
                                    pada
                                    {{ \Carbon\Carbon::parse($lowongan->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y ') }}
                                    ,
                                    {{ $lowongan->created_at->diffForHumans() }}</p>
                                <p class="card-text"></p>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        @else
            <div class="container d-flex justify-content-center">
                <img class="" src="{{ asset('img/no-data.png') }}" alt="" height="450" width="500"
                    style="justify-content: center">
            </div>
            <div>
                <p class="fs-3 text-center">Tidak Ada Lowongan</p>
            </div>

        @endif
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
