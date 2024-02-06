{{-- 
<div class="container">
    <div class="row g-2 mt-2 mb-4">
        @for ($i = 0; $i < count($computer_skills); $i++)
            <div class="form-check col-3">
                <input class="form-check-input" type="checkbox" value="{{ $computer_skills[$i] }}" id="flexCheckDefault"
                    name="nama_kemampuan[]" id="keahlian_komputer">
                <label class="form-check-label" for="flexCheckDefault">
                    {{ Str::title($computer_skills[$i]) }}
                </label>
            </div>
        @endfor
    </div>
    <div class="row g-2 mt-2 mb-4">
        <div class="mt-4 mb-4 mx-2">
            <h3 class="fw-bold">Software/Perangkat Lunak</h3>
        </div>
        @for ($i = 0; $i < count($software); $i++)
            <div class="form-check col-3">
                <input class="form-check-input" type="checkbox" value="{{ $software[$i] }}" id="flexCheckDefault"
                    name="software[]" id="software">
                <label class="form-check-label" for="flexCheckDefault">
                    {{ Str::title($software[$i]) }}
                </label>
            </div>
        @endfor
    </div>
    <div class="form-check col-2">
        <input class="form-check-input" type="checkbox" id="flexCheckDefault" id="lainnya">
        <label class="form-check-label" for="flexCheckDefault">
            Lainnya
        </label>
    </div>
</div> --}}


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

        <div class="container mt-5 mb-5">
            <h3>
                <p class="fw-bold">Application Form - Keahlian Komputer</p>
            </h3>
            <form action="/{{ $lowongan->slug }}/application-form/data-keahlian-komputer" method="post">
                @csrf
                <div class="container">
                    <div class="row g-2 mt-2 mb-4">
                        @for ($i = 0; $i < count($computer_skills); $i++)
                            <div class="form-check col-3">
                                <input class="form-check-input" type="checkbox" value="{{ $computer_skills[$i] }}"
                                    id="flexCheckDefault" name="nama_kemampuan[]" id="keahlian_komputer">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ Str::title($computer_skills[$i]) }}
                                </label>
                            </div>
                        @endfor
                    </div>

                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" id="skillKomputerLainnya"
                            onclick="showInputAnotherComputerSkill()">
                        <label class="form-check-label" for="flexCheckDefault">
                            Lainnya
                        </label>
                    </div>
                    <div class="mb-3 mt-3 col-6" id="input_skill_komputer_lainnya" style="display: none">
                        <div class="input-group">
                            <input type="text" class="form-control" aria-describedby="basic-addon3 basic-addon4"
                                name="nama_kemampuan[]" id="software" placeholder="Masukkan nama kemampuan komputer ">
                        </div>
                        <label for="input_software_lainnya" class="opacity-50 mx-3" style="font-size: 14px">Jika lebih dari
                            satu,
                            pisahkan dengan koma (",")</label>
                    </div>
                    <div class="row g-2 mt-2 mb-4">
                        <div class="mt-4 mb-4 mx-2">
                            <h3 class="fw-bold">Software/Perangkat Lunak</h3>
                        </div>
                        @for ($i = 0; $i < count($software); $i++)
                            <div class="form-check col-3">
                                <input class="form-check-input" type="checkbox" value="{{ $software[$i] }}"
                                    id="flexCheckDefault" name="software[]" id="software">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ Str::title($software[$i]) }}
                                </label>
                            </div>
                        @endfor
                    </div>

                    <div class="form-check col-2">
                        <input class="form-check-input" type="checkbox" id="softwareLainnya"
                            onclick="showInputAnotherSoftware()">
                        <label class="form-check-label" for="flexCheckDefault">
                            Lainnya
                        </label>
                    </div>
                    <div class="mb-3 mt-3 col-6" id="input_software_lainnya" style="display: none">
                        <div class="input-group">
                            <input type="text" class="form-control" aria-describedby="basic-addon3 basic-addon4"
                                name="software[]" id="software" placeholder="Masukkan nama software ">
                        </div>
                        <label for="input_software_lainnya" class="opacity-50 mx-3" style="font-size: 14px">Jika lebih dari
                            satu,
                            pisahkan dengan koma (",")</label>
                    </div>
                </div>

                <div class="mt-5">
                    <button type="button" name="previous" id="previous-button" class="btn btn-primary">Sebelumnya</button>
                    <button type="submit" name="next" class="btn btn-secondary">Selanjutnya</button>
                </div>
            </form>

        </div>

    @endauth


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/application_form.js') }}"></script>

</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the "Previous" button element by its ID
        const previousButton = document.getElementById('previous-button');

        // Add a click event listener to the "Previous" button
        previousButton.addEventListener('click', function() {
            // Navigate back to the previous step, e.g., Step 1
            window.location.href =
                "{{ route('application-forms.tambah-data-riwayat-pendidikan', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });
</script>
