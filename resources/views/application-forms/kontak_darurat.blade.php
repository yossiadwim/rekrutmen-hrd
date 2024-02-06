

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

    @include('partials.navbar')

    @include('partials.notification_pelamar')

    <div class="container mt-5 mb-5">
        <h3>
            <p class="fw-bold">Application Form - Kontak Darurat</p>
        </h3>
        <form action="/{{ $lowongan->slug }}/application-form/data-kontak-darurat" method="post">
            @csrf
            <table class="table mt-4" id="tableKontakDarurat">
                <caption>Dalam keadaan darurat siapakah yang dapat kami hubungi?</caption>
                <thead class="text-center">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Hubungan</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody id="table-kontak-darurat">
                    <tr id="table-row-kontak-darurat">
                        <td>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="hubungan" name="hubungan"
                                placeholder="Hubungan">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="telepon" name="telepon"
                                placeholder="Telepon">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="Alamat">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="col-3 mt-4">
                <button type="button" class="btn btn-success" id="add-emergency-contact-row"><i
                        class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah</button>
            </div>

            <div class="mt-5">
                <button type="button" name="previous" id="previous-button" class="btn btn-primary">Sebelumnya</button>
                <button type="submit" name="next" class="btn btn-secondary">Selanjutnya</button>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/application_form.js') }}"></script>
</body>

</html>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the "Previous" button element by its ID
        const previousButton = document.getElementById('previous-button');

        // Add a click event listener to the "Previous" button
        previousButton.addEventListener('click', function() {
            // Navigate back to the previous step, e.g., Step 1
            window.location.href =
                "{{ route('application-forms.tambah-data-pengalaman-organisasi', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });
</script>
