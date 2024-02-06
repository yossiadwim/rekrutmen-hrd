<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yayasan SATUNAMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/admin-dashboard-style.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script src="//cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>

</head>

<body style="font-family: Poppins">
    @include('partials.navbar')

    <div class="container mt-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin-dashboard/lowongan">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buat Lowongan</li>
            </ol>
        </nav>
    </div>

    <div class="container mt-5 d-flex justify-content-center">
        <h3 class="fw-bold">Buat Lowongan Kerja</h3>
    </div>

    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif --}}

    <div class="container rounded border border-2 mt-2 mb-5">
        <form method="post" action="/admin-dashboard/lowongan">
            @csrf
            <div class="container mt-5">
                <div class="col-md-12">
                    <div class="mb-3 col-md-6">
                        <label for="nama_lowongan" class="form-label">Nama Lowongan</label>
                        <input type="text"
                            class="form-control @error('nama_lowongan')
                            is-invalid
                        @enderror"
                            id="nama_lowongan" name="nama_lowongan" value="{{ old('nama_lowongan') }}">
                        @error('nama_lowongan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12" hidden>
                    <div class="mb-3 col-md-6 mt-5">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            value="{{ old('slug') }}" placeholder="Terisi otomatis">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3 col-md-6 mt-5">
                        <input type="hidden" name="closed" value="false">
                    </div>
                </div>
                <div class="mb-3 col-md-6 mt-5">
                    <label for="departemen" class="form-label">Departemen</label>
                    <select
                        class="form-select @error('id_departemen')
                        is-invalid
                    @enderror"
                        id="departemen" name="id_departemen">
                        <option value="---" selected disabled>---</option>
                        @foreach ($departemen as $dp)
                            <option value="{{ $dp->id_departemen }}">{{ $dp->nama_departemen }}</option>
                        @endforeach
                    </select>
                    @error('id_departemen')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 col-md-3 mt-5">
                    <select
                        class="form-select @error('tipe_lowongan')
                        is-invalid
                    @enderror"
                        aria-label="Default select example" name="tipe_lowongan">
                        <option selected disabled>Tipe Lowongan</option>
                        <option value="Magang">Magang</option>
                        <option value="Kontrak">Kontrak</option>
                        <option value="Harian">Harian</option>
                        <option value="Tetap">Karyawan Tetap</option>
                    </select>
                    @error('tipe_lowongan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="mb-3 col-md-2 mt-5">
                        <label for="tanggal_tutup" class="form-label">Tanggal Tutup</label>
                        <input type="date"
                            class="form-control @error('tanggal_tutup')
                            is-invalid
                        @enderror"
                            id="tanggal_tutup" name="tanggal_tutup" value="{{ old('tanggal_tutup') }}" min="{{ now()->toDateString() }}" >
                        @error('tanggal_tutup')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 col-md-10 mt-5 ">
                    <label for="deskripsi" class="form-label">Deksripsi Lowongan</label>
                    @error('deskripsi_lowongan')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <textarea class="ckeditor form-control" name="deskripsi">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="mb-5 col-md-12 mt-5 d-flex justify-content-center">
                    <button class="btn btn-success border-0 " type="submit" id="posting-lowongan">Posting
                        Lowongan</button>
                </div>

            </div>
        </form>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>


<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    });

    const nama_lowongan = document.querySelector('#nama_lowongan');
    const slug = document.querySelector('#slug');

    nama_lowongan.addEventListener('change', function() {
        console.log(nama_lowongan.value);
        fetch('/admin-dashboard/lowongan/createSlug?nama_lowongan=' + nama_lowongan.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    })

    document.getElementById('posting-lowongan').addEventListener('click', function() {
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
