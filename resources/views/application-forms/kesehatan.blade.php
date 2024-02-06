@csrf

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

    <div class="container mt-5">
        <div class="">
            <h3>
                <p class="fw-bold">Application Form - Kondisi Kesehatan</p>
            </h3>
        </div>
        <form action="/{{ $lowongan->slug }}/application-form/data-kondisi-kesehatan" method="post">
            @csrf
            <div class="container">
                <p>Apakah anda memiliki atau pernah mengalami penyakit berikut ini?</p>
                <div class="row g-2 mt-2 mb-4">
                    @for ($i = 0; $i < count($illness); $i++)
                        <div class="form-check col-3">
                            <input class="form-check-input" type="checkbox" value="{{ $illness[$i] }}"
                                id="flexCheckDefault" name="kondisi_kesehatan[]" id="kondisi_kesehatan">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ Str::title($illness[$i]) }}
                            </label>
                        </div>
                    @endfor

                    <div class="form-check col-3">
                        <input class="form-check-input" type="checkbox" value=""
                            name="kondisi_kesehatan" id="kondisi_kesehatan_lainnya" onclick="showInputAnotherIll()">
                        <label class="form-check-label" for="flexCheckDefault">
                            Lainnya
                        </label>
                        
                    </div>
                    
                </div>

                <div class="mb-3 mt-3 col-6" id="input_penyakit_lainnya" style="display: none">
                    <div class="input-group">
                        <input type="text" class="form-control" aria-describedby="basic-addon3 basic-addon4"
                            name="kondisi_kesehatan[]" id="kondisi_kesehatan"
                            placeholder="Masukkan nama penyakit ">
                    </div>
                    <label for="input_penyakit" class="opacity-50 mx-3" style="font-size: 14px">Jika lebih dari
                        satu,
                        pisahkan dengan koma (",")</label>
                </div>

                <div>
                    <label for="basic-url" class="form-label">Adakah penyakit serius lainnya?</label> <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="adakah_penyakit_serius_lainnya"
                            id="radioYa" value="ya" onclick="showHideInputSeriousIll()">
                        <label class="form-check-label" for="inlineRadio1">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="adakah_penyakit_serius_lainnya"
                            id="radioTidak" value="tidak" onclick="showHideInputSeriousIll()">
                        <label class="form-check-label" for="inlineRadio2">Tidak</label>
                    </div>

                    <div class="mb-3 mt-3 col-6" id="group_input_penyakit_serius_lainnya" style="display: none">
                        <div class="input-group" id="input_penyakit">
                            <input type="text" class="form-control" aria-describedby="basic-addon3 basic-addon4"
                                name="nama_penyakit_lainnya" id="nama_penyakit_lainnya"
                                placeholder="Masukkan nama penyakit ">
                        </div>
                        <label for="input_penyakit" class="opacity-50 mx-3" style="font-size: 14px">Jika lebih dari
                            satu,
                            pisahkan dengan koma (",")</label>
                    </div>

                </div>
                <br>
                
                <div>
                    <label for="basic-url" class="form-label">Apakah anda pernah mengalami cedera atau operasi?</label>
                    <br>

                    <div class=" form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="apakah_pernah_mengalami_cedera_operasi"
                            id="radioButtonYa" value="ya" onclick="showHideInputCederaOperation()">
                        <label class="form-check-label" for="radioButtonYa">
                            Ya
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="apakah_pernah_mengalami_cedera_operasi"
                            id="radioButtonTidak" value="tidak" onclick="showHideInputCederaOperation()">
                        <label class="form-check-label" for="radioButtonTidak">
                            Tidak
                        </label>
                    </div>
                    <div class="mb-3 mt-3 col-4" id="group_input_pernah_cedera_atau_operasi" style="display: none">
                        <div class="input-group" id="input_cedera_operasi">
                            <input type="text" class="form-control" aria-describedby="basic-addon3 basic-addon4"
                                name="nama_cedera_atau_operasi" placeholder="Masukkan...">
                        </div>
                        <label for="input_cedera_operasi" class="opacity-50 mx-3" style="font-size: 14px">Jika lebih
                            dari
                            satu, pisahkan dengan koma (",")</label>

                    </div>
                </div>



                <div class="col-2 mb-4 mt-4">
                    <label class="form-label">Golongan Darah</label>
                    <select class="form-select" aria-label="Default select example" name="golongan_darah"
                        id="golongan_darah">
                        <option selected disabled>Pilih</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
            </div>

            <div class="mt-5">
                <button type="button" name="previous" id="previous-button"
                    class="btn btn-primary">Sebelumnya</button>
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
                "{{ route('application-forms.tambah-data-kontak-darurat', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });

    
</script>
