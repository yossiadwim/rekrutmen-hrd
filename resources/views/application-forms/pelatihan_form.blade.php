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
            <div class="mt-3">

                <h3 class="fw-bold mb-5">Application Form - Data Pelatihan yang Pernah Diikuti</h3>
            </div>
            <form action="/{{ $lowongan->slug }}/application-form/data-pelatihan-yang-diikuti" method="post">
                @csrf
                <table class="table mt-4" id="tablePelatihan">
                    <caption>Catatan: Tambahkan pelatihan yang pernah Anda ikuti</caption>
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Subjek</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Nama Mentor</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="table-body-pelatihan">

                    </tbody>
                </table>
                <input type="number" name="counter_row_pelatihan" id="counter_row_pelatihan" style="display: none"
                    value="0">

                <div class="col-3 mt-4">
                    <button type="button" class="btn btn-success" id="add-training-row"><i class="fa-solid fa-plus"
                            style="color: #ffffff;"></i> Tambah</button>
                </div>





                <div class="mt-5 mb-5 d-flex justify-content-end">
                    <button type="button" name="previous" id="previous-button"
                        class="btn btn-primary mx-2">Sebelumnya</button>
                    {{-- <button type="submit" id="submit_form" name="next" class="btn btn-secondary mx-2">Kirim Application
                        Form</button> --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Kirim Application Form
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-align-justify">
                                    <p>
                                        I hereby certify that the above information given by me is true to the best of my
                                        knowledge
                                        and understand that any false information contained in the above application may
                                        result
                                        in
                                        my immediate dismissal from the position gained at SATUNAMA Foundation
                                    </p>

                                    <p>
                                        Saya menyatakan bahwa keterangan tersebut diatas adalah benar dan apabila ada
                                        keterangan
                                        yang tidak benar saya bersedia dikeluarkan dari posisi yang saya dapatkan di Yayasan
                                        SATUNAMA
                                    </p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                    <button type="submit" id="submit_form" name="next" class="btn btn-success">Kirim
                                        
                                        </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                "{{ route('application-forms.tambah-data-referensi', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });

    $(document).ready(function() {
        var total_row_pelatihan = document.getElementById("counter_row_pelatihan");

        $('#add-training-row').click(function(e) {
            var row_pelatihan = $('<tr>')
            var col_pelatihan = "";

            col_pelatihan += ` 
        <td class="col-5">
            <input type="text" class="form-control" id="subjek_pelatihan" name="subjek_pelatihan[]" placeholder="Subjek Pelatihan" required>
        </td>
        <td class="col-1">
            <select name="tahun_pelatihan[]" id="tahun_pelatihan" class="form-select" aria-label="Default select example" required>
            <?php
            $currentYear = \Carbon\Carbon::now()->format('Y');
            $startYear = 1950; // Change this to your desired start year
            
            for ($year = $currentYear; $year >= $startYear; $year--) {
                echo '<option value="' . $year . '">' . $year . '</option>';
            }
            
            ?>
            </select>
        </td>
        <td class="col-5">
            <input type="text" class="form-control" name="nama_mentor[]" id="nama_mentor" placeholder="Nama Mentor" required>
        </td>

            <td> <button type="button" class="btn btn-danger" id="remove-pelatihan-row"></i> Hapus</button></td>`



            row_pelatihan.append(col_pelatihan);
            $("#table-body-pelatihan").append(row_pelatihan);
            total_row_pelatihan.value++;
            console.log("row pelatihan " + total_row_pelatihan.value);

        });

        $(document).on("click", "#remove-pelatihan-row", function() {
            $(this).closest("tr").remove();
            total_row_pelatihan.value--;
            console.log("row pelatihan " + total_row_pelatihan.value);
        });

    });
</script>
