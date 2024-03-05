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

        </div>

        <div class="container mt-5 mb-5 border rounded">
            <div class="mt-3">
                <h3 class="fw-bold">Application Form - Data Keluarga</h3>
            </div>
            <form action="/{{ $lowongan->slug }}/application-form/data-keluarga" method="POST">
                @csrf
                <table class="table" id="tableFamily">
                    <caption>Catatan: Tidak termasuk yang bersangkutan</caption>
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Hubungan</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th class="col-1">Umur</th>
                            <th scope="col-1">Pendidikan Terakhir</th>
                            <th scope="col">Posisi/Pekerjaan</th>
                            <th scope="col">Perusahaan</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="table-body-family">

                    </tbody>

                </table>

                <input type="number" name="counter_row_keluarga" id="counter_row_keluarga" style="display: none"
                    value="0">


                <div class="col-3 mt-4">
                    <button type="button" class="btn btn-success" id="add-family-row"><i class="fa-solid fa-plus"
                            style="color: #ffffff;"></i> Tambah</button>
                </div>


                <div class="mt-5 mb-5 d-flex justify-content-end">
                    <button type="button" name="previous" id="previous-button"
                        class="btn btn-primary mx-2">Sebelumnya</button>
                    <button type="submit" name="next" class="btn btn-secondary mx-2">Selanjutnya</button>
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
                "{{ route('application-forms.tambah-anak', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });
</script>



{{-- <div class="form-floating">
        <input type="number" class="form-control" name="jumlah_anggota_keluarga" id="jumlah_anggota_keluarga" placeholder="Jumlah Anggota Keluarga"
            onchange="addRowTableFamily()" min="0">
        <label for="jumlah_anggota_keluarga">Jumlah Anggota Keluarga</label>
    </div> --}}
{{-- <div class="col-3 mt-4">
    <button type="button" class="btn btn-success" id="add-family-row"><i class="fa-solid fa-plus"
            style="color: #ffffff;"></i> Tambah</button>
</div> --}}
