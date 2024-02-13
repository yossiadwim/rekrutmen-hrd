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
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>
</head>

<body>

    @include('partials.navbar')

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-container mt-5">
                <main class="form-registration w-100 m-auto">
                    <h1 class="mb-3 fw-bold text-center">Daftar</h1>
                    <h6 class="mt-3 mb-5 fw-normal text-center">Masukkan data dibawah ini dengan benar.</h6>
                    <form action="/register" method="post" class="mt-5">
                        @csrf
                        <div class="form-floating">
                            <input type="text" name="nama_pelamar"
                                class="form-control rounded @error('nama_pelamar')
                      is-invalid
                    @enderror"
                                id="nama_pelamar" placeholder="name@example.com" value="{{ old('nama_pelamar') }}">
                            <label for="name_pelamar">Nama Lengkap</label>
                            @error('nama_pelamar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-floating" hidden>
                            <input type="text" class="form-control rounded mt-3" id="slug" name="slug"
                                value="{{ old('slug') }}">
                            <label for="slug">Slug</label>
                        </div>

                        <div class="form-floating">
                            <input type="text" name="username"
                                class="form-control rounded mt-3 @error('username')
                      is-invalid
                    @enderror"
                                id="username" placeholder="Username" value="{{ old('username') }}">
                            <label for="username">Username</label>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input type="email" name="email"
                                class="form-control rounded mt-3 @error('email')
                      is-invalid
                    @enderror"
                                id="email" placeholder="name@example.com" value="{{ old('email') }}">
                            <label for="email">Email</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password"
                                class="form-control rounded mt-3 @error('password')
                      is-invalid
                    @enderror"
                                id="password" placeholder="Password">
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password_confirmation"
                                class="form-control rounded mt-3 @error('confirm_password')
                      is-invalid
                    @enderror"
                                id="password_confirmation" placeholder="Konfirmasi Password">
                            <label for="password">Konfirmasi Password</label>
                            @error('confirm_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <button class="btn btn-lg btn-dark btn-bg-custom mt-5 btn" id="button-register"
                                type="submit">Daftar</button>

                        </div>


                    </form>
                    <small class="d-block text-center mt-3">Sudah mempunyai Akun? <a href="/login">Login</a></small>
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
    const nama = document.querySelector('#nama_pelamar');
    const slug = document.querySelector('#slug');

    nama.addEventListener('change', function() {
        console.log(nama.value);
        fetch('/register/createSlug?nama=' + nama.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    })

    document.getElementById('button-register').addEventListener('click', function() {
        const loader = document.getElementById('loader');

        // Display the loader
        loader.style.display = 'flex';

        // Simulate a form submission delay (replace with your actual form submission logic)
        setTimeout(function() {
            // Hide the loader when the form submission is complete
            loader.style.display = 'none';
        }, 2500); // Simulate a 2-second delay; replace with actual form submission time
    });


</script>
