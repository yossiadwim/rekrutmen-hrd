@if (in_array($data->pelamar->id, $pengalamanKerjaId))
    <table class="table" id="tableRiwayatPendidikan">
        <thead class="">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Perusahaan</th>
                <th scope="col">Email Instansi</th>
                <th scope="col">No Telepon</th>
                <th scope="col">Posisi</th>
                <th scope="col">Periode</th>
                <th scope="col">Gaji</th>
                <th scope="col">Alasan Mengundurkan Diri</th>



            </tr>
        </thead>
        <tbody id="table-body-riwayat-pekerjaan">
            @for ($i = 0; $i < count($data->pelamar->pengalamanKerja); $i++)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $data->pelamar->pengalamanKerja[$i]->nama_perusahaan }}
                    </td>
                    <td>{{ $data->pelamar->pengalamanKerja[$i]->email_instansi }}
                    </td>
                    <td>{{ $data->pelamar->pengalamanKerja[$i]->telepon }}</td>
                    <td>{{ $data->pelamar->pengalamanKerja[$i]->posisi }}</td>
                    <td>{{ $data->pelamar->pengalamanKerja[$i]->periode }}</td>
                    <td>{{ $data->pelamar->pengalamanKerja[$i]->gaji }}</td>
                    <td>{{ $data->pelamar->pengalamanKerja[$i]->alasan_mengundurkan_diri }}
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
@else
    <h5 class="text-center"></h5>
@endif
