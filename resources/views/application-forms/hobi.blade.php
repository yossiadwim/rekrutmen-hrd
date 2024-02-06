{{-- <!DOCTYPE html>
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
</head>

<body style="font-family: Poppins;">

    @auth
        @include('partials.navbar')

        @include('partials.notification_pelamar')

        <div class="container">
            <form action="/{{ $lowongan->slug }}/application-form/data-hobi" method="POST">
                @csrf
                <div class="mb-3 mt-3 col-6">
                    <div class="input-group" id="">
                        <textarea class="form-control" placeholder="Masukkan hobi Anda" id="hobi" name="hobi[]"></textarea>
                    </div>
                    <label for="hobi" class="opacity-50 mx-1" style="font-size: 14px">Jika lebih dari satu, pisahkan
                        dengan koma (",")</label>
                </div>

                <div class="mt-5">
                    <button type="submit" name="previous" class="btn btn-primary">Sebelumnya</button>
                    <button type="submit" name="next" class="btn btn-secondary">Selanjutnya</button>
                </div>

            </form>
        </div>



    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html> --}}
