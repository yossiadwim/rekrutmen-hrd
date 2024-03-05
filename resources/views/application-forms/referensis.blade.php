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

                <h3 class="fw-bold mb-5">Application Form - Data Referensi</h3>
            </div>
            <form action="/{{ $lowongan->slug }}/application-form/data-referensi" method="post">
                @csrf
                @if ($referensiExists)
                    <table class="table  mt-4" id="tableReferensi">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Telepon</th>
                                <th scope="col">Email</th>
                                <th scope="col">Hubungan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="table-body-referensi">
                            @foreach ($referensis as $ref)
                                @if ($ref->posisi_referensi == null)
                                    <tr id="table-row-referensi">
                                        <td>
                                            <input type="text" class="form-control" id="nama_referensi"
                                                name="nama_referensi" placeholder="Nama Referensi"
                                                value="{{ old('nama_referensi', $ref->nama_referensi) == null ? '' : $ref->nama_referensi }}"
                                                disabled>

                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="alamat_referensi"
                                                name="alamat_referensi" placeholder="Posisi"
                                                value="{{ old('alamat_referensi', $ref->alamat_referensi) == null ? '' : $ref->alamat_referensi }}"
                                                disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="telepon_referensi"
                                                name="telepon_referensi" placeholder="Telepon"
                                                value="{{ old('telepon_referensi', $ref->telepon_referensi) == null ? '' : $ref->telepon_referensi }}"
                                                disabled>
                                        </td>
                                        <td>
                                            <input type="email" class="form-control" id="email_referensi"
                                                name="email_referensi" placeholder="Email"
                                                value="{{ old('email_referensi', $ref->email_referensi) == null ? '' : $ref->email_referensi }}"
                                                disabled>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="hubungan_referensi"
                                                name="hubungan_referensi" placeholder="Hubungan"
                                                value="{{ old('telepon_referensi', $ref->hubungan_referensi) == null ? '' : $ref->hubungan_referensi }}"
                                                disabled>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                        <tbody id="table-body-referensi-2">

                        </tbody>
                    </table>

                    <input type="number" name="counter_row_referensi" id="counter_row_referensi" style="display: none"
                        value="0">


                    <div class="col-3 mt-4">
                        <button type="button" class="btn btn-success" id="add-reference-not-satunama-row"><i
                                class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah</button>
                    </div>

                    <div class="mt-5 mb-5">
                        <div class="mt-4 mb-4 mx-2">
       
                        </div>
                        <div class="">
                            <table class="table  mt-4" id="tableReferensi">
                                <caption>Relasi Atau Teman, Jika Ada, Yang Bekerja Di Yayasan SATUNAMA</caption>
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Posisi</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Hubungan</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="table-body-referensi-satunama">
                                    @foreach ($referensis as $ref)
                                        @if ($ref->posisi_referensi != null)
                                            <tr id="table-row-referensi">
                                                <td>
                                                    <input type="text" class="form-control" id="nama_referensi"
                                                        name="nama_referensi" placeholder="Nama Referensi"
                                                        value="{{ old('nama_referensi', $ref->nama_referensi) == null ? '' : $ref->nama_referensi }}"
                                                        disabled>

                                                </td>
                                                <td>
                                                    <input type="email" class="form-control" id="email_referensi"
                                                        name="email_referensi" placeholder="Posisi"
                                                        value="{{ old('email_referensi', $ref->email_referensi) == null ? '' : $ref->email_referensi }}"
                                                        disabled>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="telepon_referensi"
                                                        name="telepon_referensi" placeholder="Posisi"
                                                        value="{{ old('telepon_referensi', $ref->telepon_referensi) == null ? '' : $ref->telepon_referensi }}"
                                                        disabled>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="posisi_referensi"
                                                        name="posisi_referensi" placeholder="Posisi"
                                                        value="{{ old('posisi_referensi', $ref->posisi_referensi) == null ? '' : $ref->posisi_referensi }}"
                                                        disabled>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="alamat_referensi"
                                                        name="alamat_referensi" placeholder="Posisi"
                                                        value="{{ old('alamat_referensi', $ref->alamat_referensi) == null ? '' : $ref->alamat_referensi }}"
                                                        disabled>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="hubungan_referensi"
                                                        name="hubungan_referensi" placeholder="Hubungan"
                                                        value="{{ old('telepon_referensi', $ref->hubungan_referensi) == null ? '' : $ref->hubungan_referensi }}"
                                                        disabled>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tbody id="table-body-referensi-satunama-2">

                                </tbody>
                            </table>

                            <input type="number" name="counter_row_referensi_from_satunama"
                                id="counter_row_referensi_from_satunama" style="display: none" value="0">
                            <div class="col-3 mt-4">
                                <button type="button" class="btn btn-success" id="add-reference-from-satunama"><i
                                        class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah</button>
                            </div>
                        </div>
                    </div>
                @else
                    <table class="table mt-4" id="tableReferensi">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Telepon</th>
                                <th scope="col">Email</th>
                                <th scope="col">Hubungan</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-referensi-2">

                        </tbody>
                    </table>
                    <input type="number" name="counter_row_referensi" id="counter_row_referensi" style="display: none"
                        value="0">
                    <div class="col-3 mt-4">
                        <button type="button" class="btn btn-success" id="add-reference-not-satunama-row"><i
                                class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah</button>
                    </div>

                    <div class="mt-5 mb-4 mx-2">
                        
                    </div>
                    <div class="">
                        <table class="table mt-4" id="tableReferensi">
                            <caption>Relasi Atau Teman, Jika Ada, Yang Bekerja Di Yayasan SATUNAMA</caption>
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Posisi</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Hubungan</th>
                                </tr>
                            </thead>
                            <tbody id="table-body-referensi-satunama-2">

                            </tbody>
                        </table>
                        <input type="number" name="counter_row_referensi_from_satunama"
                            id="counter_row_referensi_from_satunama" style="display: none" value="0">
                    </div>
                    <div class="col-3 mt-4">
                        <button type="button" class="btn btn-success" id="add-reference-from-satunama"><i
                                class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah</button>
                    </div>
                @endif
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
                "{{ route('application-forms.tambah-data-pengalaman-kerja', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });
</script>
