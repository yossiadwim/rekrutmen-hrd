@if (in_array($data->pelamar->id, $pengalamanOrgId))
    <table class="table mt-4" id="tablePengalamanOrganisasi">
        <thead class="">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Organisasi</th>
                <th scope="col">Posisi</th>


            </tr>
        </thead>
        <tbody id="tableOrganisasi">
            <tr>
                @foreach ($data->pelamar->pengalamanOrganisasi as $index => $data_pengalaman_organisasi)
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data_pengalaman_organisasi->nama_organisasi }}</td>
                    <td>{{ $data_pengalaman_organisasi->posisi_di_organisasi }}
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
@else
    <h5 class="text-center">Tidak Ada Data</h5>
@endif
