@if (in_array($data->pelamar->id, $pendidikanId))
    <table class="table" id="tableRiwayatPendidikan">
        <thead class="">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Jenjang</th>
                <th scope="col">Nama Sekolah/Universitas</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Tahun Selesai</th>
                <th scope="col">Indeks Prestasi Kumulatif (IPK)</th>



            </tr>
        </thead>
        <tbody id="table-body-riwayat-pendidikan">

            @for ($i = 0; $i < count($data->pelamar->pendidikan); $i++)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $data->pelamar->pendidikan[$i]->jenjang_pendidikan }}
                    </td>
                    <td>{{ $data->pelamar->pendidikan[$i]->nama_institusi }}</td>
                    <td>{{ $data->pelamar->pendidikan[$i]->jurusan == null ? '-' : $data->pelamar->pendidikan[$i]->jurusan }}
                    </td>
                    <td>{{ $data->pelamar->pendidikan[$i]->tahun_lulus }}</td>
                    <td>{{ $data->pelamar->pendidikan[$i]->ipk == null ? '-' : $data->pelamar->pendidikan[$i]->ipk }}
                    </td>
                </tr>
            @endfor

        </tbody>
    </table>
@else
    <h5 class="text-center">Tidak Ada Data</h5>
@endif
