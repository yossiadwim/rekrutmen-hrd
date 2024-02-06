<div class="row">
    <div class="col">
        <div class="form-floating ">
            <input type="text" class="form-control" name="posisi_lowongan" id="nama_lowongan"
                placeholder="Posisi yang dilamar" value="{{ $data->lowongan->nama_lowongan }}" disabled>
            <label for="floatingInput">Posisi yang dilamar</label>

        </div>
    </div>

</div>
<div class="row mt-5 ">
    <div class="col d-flex justify-content-center align-items-center">

        <div class="col">
            <div class="form-floating">
                <input type="text" class="form-control " id="nama_pelamar" name="nama_pelamar"
                    placeholder="Nama Pelamar" value="{{ $data->pelamar->nama_pelamar }}" required disabled>
                <label for="nama_pelamar">Nama Pelamar</label>

            </div>
        </div>
    </div>
</div>
<div class="row mt-5 ">

    <div class="col">
        <div class="form-floating">
            <input type="text" class="form-control " id="nik" name="nik" placeholder="Nomor Identitas"
                maxlength="16" disabled value="{{ $data->pelamar->nik }}">
            <label for="nik">Nomor Induk kependudukan</label>
        </div>
    </div>
</div>

<div class="row mt-5 ">

    <div class="col">
        <div class="form-floating">
            <input type="text" class="form-control currency " id="gaji" placeholder="Gaji yang diharapkan"
                name="ekspetasi_gaji" disabled value="@currency($data->pelamar->ekspetasi_gaji)"
                {{ $data->pelamar->ekspetasi_gaji == null ? 'required' : 'disabled' }}>

            <label for="gaji">Gaji yang diharapkan</label>

        </div>
    </div>
</div>

<div class="row mt-5">

    <div class=" col">
        <div class="form-floating">
            <input type="text" class="form-control" id="alamat" placeholder="Alamat"
                value="{{ $data->pelamar->alamat == null ? '' : $data->pelamar->alamat }}" disabled>
            <label for="alamat">Alamat</label>

        </div>
    </div>
</div>
<div class="row mt-5">

    <div class="col">
        <div class="form-floating">
            <input type="text" class="form-control " id="alamat_tetap" name="alamat_tetap" placeholder="Alamat"
                value="{{ $data->pelamar->alamat_tetap }}" disabled>
            <label for="alamat_tetap">Alamat Tetap</label>
        </div>


    </div>
</div>
<div class="row mt-5">

    <div class="col">
        <div class="form-floating">
            <input type="text" class="form-control" id="telepon_rumah" name="telepon_rumah"
                placeholder="Telepon Rumah" value="{{ $data->pelamar->telepon_rumah }}" maxlength="12" disabled>
            <label for="telepon_rumah">Telpon Rumah</label>

        </div>
    </div>
</div>
<div class="row mt-5">

    <div class="col">
        <div class="form-floating">
            <input type="text" class="form-control " id="telepon_kantor" name="telepon_kantor"
                placeholder="Telepon Kantor" value="{{ $data->pelamar->telepon_kantor }}" maxlength="12" disabled>
            <label for="telepon_kantor">Telepon Kantor</label>
        </div>
    </div>
</div>
<div class="row mt-5">

    <div class="col-4">
        <div class="form-floating">
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin"
                aria-label="Floating label select example" disabled>
                <option value="" disabled>Pilih</option>
                @if (old('jenis_kelamin', $data->pelamar->jenis_kelamin) == 'laki-laki')
                    <option value="laki-laki" selected>Laki-laki</option>
                @elseif(old('jenis_kelamin', $data->pelamar->jenis_kelamin) == 'perempuan')
                    <option value="perempuan" selected>Perempuan</option>
                @else
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                @endif

            </select>
            <label for="floatingSelect">Jenis Kelamin</label>
        </div>
    </div>
</div>
<div class="row mt-5">

    <div class=" col">
        <div class="form-floating">
            <input type="text" class="form-control" id="suku" name="suku" placeholder="suku"
                value="{{ $data->pelamar->suku }}" disabled>
            <label for="suku">Suku/Keturunan</label>
        </div>
    </div>
</div>
<div class="row mt-5">


    <div class=" col">
        <div class="form-floating">
            <select class="form-select selectpicker" data-live-search="true" data-show-subtext="true"
                id="kebangsaan" name="kebangsaan" aria-label="Floating label select example"disabled>
                @foreach ($countries as $country)
                    @if (old('kebangsaan', $country) == $data->pelamar->kebangsaan)
                        <option value="{{ $data->pelamar->kebangsaan }}" selected>
                            {{ $data->pelamar->kebangsaan }}
                        </option>
                    @else
                        <option value="{{ $country }}">{{ $country }}
                        </option>
                    @endif
                @endforeach

            </select>
            <label for="kebangsaan">Kewarganegaraan</label>
        </div>

    </div>
</div>
<div class="row mt-5">

    <div class="col-4">
        <div class="form-floating">
            <select class="form-select" id="id_agama" name="id_agama" aria-label="Floating label select example"
                disabled>
                <option value="" selected disabled>Pilih</option>
                @foreach ($religions as $religion)
                    @if (old('id_agama', $religion->id_agama) == $data->pelamar->id_agama)
                        <option value="{{ $religion->id_agama }}" selected>
                            {{ $religion->nama_agama }}
                        </option>
                    @endif
                @endforeach
            </select>
            <label for="agama">Agama</label>

        </div>
    </div>
</div>
<div class="row mt-5">

    <div class=" col">
        <div class="form-floating">
            <input type="text" class="form-control 
            
                            " id="tempat_lahir"
                name="tempat_lahir" placeholder="tempat_lahir"
                value="{{ $data->pelamar->tempat_lahir == null ? '' : $data->pelamar->tempat_lahir }}" disabled>
            <label for="tempat_lahir">Tempat Lahir</label>

        </div>
    </div>
</div>
<div class="row mt-5">

    <div class="col-4">
        <div class="form-floating">
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                placeholder="Tanggal Lahir" value="{{ $data->pelamar->tanggal_lahir }}" disabled>
            <label for="tanggal_lahir">Tanggal Lahir</label>
        </div>
    </div>
</div>
<div class="row mt-5">

    <div class="col-3">
        <div class="form-floating">
            <input type="text"
                class="form-control 
                            
                                    "
                id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan"
                value="{{ $data->pelamar->tinggi_badan == null ? '' : $data->pelamar->tinggi_badan }}" maxlength="3"
                disabled>
            <label for="tinggi_badan">Satuan centimeter (cm)</label>

        </div>
    </div>
</div>
<div class="row mt-5">

    <div class="col-3">
        <div class="form-floating">
            <input type="text" class="form-control " id="berat_badan" name="berat_badan" maxlength="3"
                placeholder="Berat Badan"
                value="{{ $data->pelamar->berat_badan == null ? '' : $data->pelamar->berat_badan }}" disabled>
            <label for="berat_badan">Satuan kilogram (kg)</label>

        </div>
    </div>
</div>
<div class="row mt-5">

    <div class="col-4">
        <div class="form-floating">
            @if ($data->pelamar->status_kawin == 'belum_kawin')
                <input type="text" class="form-control" id="status_kawin" placeholder="Status Kawin"
                    value="Belum Kawin" disabled>
            @elseif ($data->pelamar->status_kawin == 'kawin')
                <input type="text" class="form-control" id="status_kawin" placeholder="Status Kawin"
                    value="Kawin"disabled>
            @elseif ($data->pelamar->status_kawin == 'cerai_hidup')
                <input type="text" class="form-control" id="status_kawin" placeholder="Status Kawin"
                    value="Cerai Hidup"disabled>
            @elseif ($data->pelamar->status_kawin == 'cerai_mati')
                <input type="text" class="form-control" id="status_kawin" placeholder="Status Kawin"
                    value="Cerai Mati"disabled>
            @endif

            <label for="status_kawin">Status Kawin</label>

        </div>

    </div>
</div>
<div class="row mt-5 mb-5">

    <div class=" col">
        <div class="form-floating">
            <input type="text" class="form-control " id="nama_pasangan" name="nama_pasangan"
                placeholder="Nama Suami/Istri"
                value="{{ $data->pelamar->nama_pasangan == null ? '-' : $data->pelamar->nama_pasangan }} "disabled>
            <label for="nama_pasangan">Nama Suami/Istri</label>

        </div>
    </div>
</div>
