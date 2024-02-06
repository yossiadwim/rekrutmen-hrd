@if (in_array($data->pelamar->id, $kondisiKesehatanId))
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kondisi Kesehatan</th>
                <th scope="col">Adakah Penyakit Serius Lainnya?</th>
                <th scope="col">Nama Penyakit Lainnya</th>
                <th scope="col">Apakah Pernah Mengalami Cedera/Operasi?</th>
                <th scope="col">Nama Cedera/Operasi</th>
                <th scope="col">Golongan Darah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($data->pelamar->kondisiKesehatan as $index => $data_kondisi_kesehatan)
                    <td>{{ $index + 1 }}</td>
                    <td>{{ Str::title($data_kondisi_kesehatan->kondisi_kesehatan) }}
                    </td>
                    <td>{{ $data_kondisi_kesehatan->adakah_penyakit_serius_lainnya }}
                    </td>
                    <td>{{ $data_kondisi_kesehatan->nama_penyakit_lainnya == null ? '-' : Str::title($data_kondisi_kesehatan->nama_penyakit_lainnya) }}
                    </td>
                    <td>{{ $data_kondisi_kesehatan->apakah_pernah_mengalami_cedera_operasi }}
                    </td>
                    <td>{{ $data_kondisi_kesehatan->nama_cedera_atau_operasi == null ? '-' : Str::title($data_kondisi_kesehatan->nama_cedera_atau_operasi) }}
                    </td>
                    <td>{{ $data_kondisi_kesehatan->golongan_darah }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
@else
    <h5 class="text-center">Tidak Ada Data</h5>
@endif
