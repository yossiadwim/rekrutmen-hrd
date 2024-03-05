
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
</head>

<body style="font-family: Poppins;">


    @auth

        @include('partials.navbar')

        @include('partials.notification_pelamar')

        <div class="container mt-5 mb-3 ">
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
                <h3 class="fw-bold">Application Form - Data Anak</h3>
            </div>
            <form action="/{{ $lowongan->slug }}/application-form/data-anak" method="POST">
                @csrf
                <table class="table mt-4" id="tableAnak">
                    <caption>Lewati langkah ini jika belum mempunyai anak</caption>
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Nama Anak</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Umur</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="table-body-children">
                        {{-- <td>
                            <input type="text" class="form-control" id="nama_anak" name="nama_anak[]"
                                placeholder="Nama Anak" >
                        </td>
                        <td>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin_anak[]"
                                aria-label="Floating label select example" >
                                <option value="" selected disabled>Pilih</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>

                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="umur_anak[]" id="umur" placeholder="Umur"
                                min="0" >
                        </td>
                        <td id="col-4">
                            <button type="button" class="btn btn-danger" id="remove-children-row">Hapus</button>
                        </td> --}}
                    </tbody>
                </table>
                <div class="col-3 mt-4">
                    <button type="button" class="btn btn-success" id="add-children-row"><i class="fa-solid fa-plus"
                            style="color: #ffffff;"></i> Tambah</button>

                    <input type="number" name="counter_row_anak" id="counter_row_anak" style="display: none" value="0">
                </div>

                <div class="mt-5 mb-5 d-flex justify-content-end ">
                    <button type="button" name="previous" id="previous-button" class="btn btn-primary mx-2">Sebelumnya</button>
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
            window.location.href = "{{ route('application-form.tambah-data-pribadi',[
                'user' => $user,
                'lowongan' => $lowongan
            ]) }}";
        });
    });
</script>

