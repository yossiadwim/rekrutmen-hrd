<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SATUNAMA | Rekrutmen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/login-style.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>

</head>

<body style="font-family: Poppins">

    @include('partials.navbar')

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-container mt-5">
                @if (session()->has('sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('sukses') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('session timeout'))
                    <div class="container justify-content-center mt-3 ">
                        <div class="alert alert-info alert-dismissible fade show" role="alert"
                            style="text-align: center">
                            {{ session('session timeout') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif

            
                <main class="form-signin w-100 m-auto">
                    <h1 class="mb-3 fw-bold text-center">Login</h1>
                    <h6 class="mt-3 mb-5 fw-normal text-center">Masukkan email dan sandi anda.</h6>
                    <form action="/login" method="post">
                        @csrf
                        <div class="form-floating">

                            <input type="email" name="email"
                                class="form-control rounded @error('email') is-invalid @enderror" id="email"
                                placeholder="name@example.com" autofocus value="{{ old('email') }}">
                            <label for="email">Email</label>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="form-floating">
                            <input type="password" name="password"
                                class="form-control rounded mt-4  @error('password') is-invalid @enderror"
                                id="password" placeholder="Password">
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-center">
                            <button class="btn btn-lg btn-dark btn-bg-custom mt-5 btn" id="button-login"
                                type="submit">Login</button>
                        </div>
                    </form>

                    <small class="d-block text-center mt-3">Belum mempunyai akun? <a href="/register">Daftar</a></small>
                    <small class="d-block text-center mt-3">atau login dengan</small>
                    {{-- <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('google-auth') }}"><img src="{{ asset('img/google.png') }}" class="mt-4"
                                alt="Gambar" width="40" height="40"></a>
                    </div> --}}
                </main>
            </div>
        </div>
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

<script>
    document.getElementById('button-login').addEventListener('click', function() {
        const loader = document.getElementById('loader');

        // Display the loader
        loader.style.display = 'flex';

        // Simulate a form submission delay (replace with your actual form submission logic)
        setTimeout(function() {
            // Hide the loader when the form submission is complete
            loader.style.display = 'none';
        }, 5000); // Simulate a 2-second delay; replace with actual form submission time
    });


    
</script>
