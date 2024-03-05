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

        <div class="container mt-5 mb-5 border rounded">
            <h3>
                <p class="fw-bold mt-3">Application Form - Penguasaan Bahasa</p>
            </h3>
            <form action="/{{ $lowongan->slug }}/application-form/data-penguasaan-bahasa" method="post">
                @csrf
                <div class="col-6">
                    <table class="table mt-4" id="tablePenguasaanBahasa">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Bahasa</th>
                                <th scope="col">Tingkatan Penguasaan</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody id="table-body-penguasaan-bahasa">

                        </tbody>
                    </table>

                    <input type="number" name="counter_row_penguasaan_bahasa" id="counter_row_penguasaan_bahasa"
                        style="display: none" value="0">

                </div>

                <div class="col-3 mt-4">
                    <button type="button" class="btn btn-success" id="add-language-row"><i class="fa-solid fa-plus"
                            style="color: #ffffff;"></i> Tambah</button>
                </div>

                <div class="mt-5 d-flex justify-content-end mb-5">
                    <button type="button" name="previous" id="previous-button" class="btn btn-primary mx-2">Sebelumnya</button>
                    <button type="submit" name="next" class="btn btn-secondary mx-2">Selanjutnya</button>
                </div>

            </form>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="{{ asset('js/application_form.js') }}"></script>

    @endauth
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
                "{{ route('application-forms.tambah-data-keahlian-komputer', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });


    $(document).ready(function() {
        var total_row_penguasaan_bahasa = document.getElementById("counter_row_penguasaan_bahasa");
        var total_row_pelatihan = document.getElementById("counter_row_pelatihan");

        $('#add-language-row').click(function(e) {
            var row_language = $('<tr>')
            var col_language = "";

            col_language += ` 
        <td>
        <select class="form-select" aria-label="Default select example" name="nama_bahasa[]" id="nama_bahasa">

            <option selected disabled>Pilih</option>

            <?php
            foreach ($languages as $lang) {
                echo '<option value="' . $lang . '">' . $lang . '</option>';
            }
            
            ?>

        </select>

    </td>
    <td>
        <select class="form-select" aria-label="Default select example" name="tingkat_penguasaan[]"
            id="tingkat_penguasaan">
            <option selected disabled>Pilih</option>
            <option value="Baik Sekali">Baik Sekali</option>
            <option value="Baik">Baik</option>
            <option value="Cukup">Cukup</option>
        </select>
    </td>

            <td> <button type="button" class="btn btn-danger" id="remove-language-row"></i> Hapus</button></td>`



            row_language.append(col_language);
            $("#table-body-penguasaan-bahasa").append(row_language);
            total_row_penguasaan_bahasa.value++;
            console.log("row penguasaan bahasa " + total_row_penguasaan_bahasa.value);


        });

        $(document).on("click", "#remove-language-row", function() {
            $(this).closest("tr").remove();
            total_row_penguasaan_bahasa.value--;
            console.log("row penguasaan bahasa " + total_row_penguasaan_bahasa.value)

        });


    })
</script>
