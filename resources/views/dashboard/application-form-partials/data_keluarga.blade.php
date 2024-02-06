<div class="">
    @if (in_array($data->pelamar->id, $keluargaId))
        <table class="table" id="tableFamily">
            <thead class="">
                <tr>
                    <th scope="col">No</th> 
                    <th scope="col">Hubungan</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Pendidikan Terakhir</th>
                    <th scope="col">Posisi</th>
                    <th scope="col">Perusahaan</th>
                </tr>
            </thead>
            <tbody id="table-body-family">
                @for ($i = 0; $i < count($data->pelamar->keluargaPelamar); $i++)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $data->pelamar->keluargaPelamar[$i]->hubungan_keluarga }}</td>
                        <td>{{ $data->pelamar->keluargaPelamar[$i]->nama_anggota_keluarga }}</td>
                        <td>{{ $data->pelamar->keluargaPelamar[$i]->jenis_kelamin_anggota_keluarga }}
                        </td>
                        <td>{{ $data->pelamar->keluargaPelamar[$i]->umur_anggota_keluarga }}</td>
                        <td>{{ $data->pelamar->keluargaPelamar[$i]->jenjang_pendidikan_anggota_keluarga }}
                        </td>
                        <td>{{ $data->pelamar->keluargaPelamar[$i]->pekerjaan_anggota_keluarga }}
                        </td>
                        <td>{{ $data->pelamar->keluargaPelamar[$i]->perusahaan_tempat_bekerja }}
                        </td>
                    </tr>
                @endfor

            </tbody>
        </table>
    @else
        <h5 class="text-center">Tidak Ada Data</h5>
    @endif
</div>
