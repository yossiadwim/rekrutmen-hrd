@if (in_array($data->pelamar->id, $kontakDaruratId))
    <table class="table mt-4" id="tableKontakDarurat">
        <thead class="">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Hubungan</th>
                <th scope="col">Telepon</th>
                <th scope="col">Alamat</th>
            </tr>
        </thead>
        <tbody id="table-kontak-darurat">
            <tr>
                @foreach ($data->pelamar->kontakDarurat as $index => $data_kontak_darurat)
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data_kontak_darurat->nama_kontak }}</td>
                    <td>{{ $data_kontak_darurat->hubungan_kontak }}</td>
                    <td>{{ $data_kontak_darurat->telepon_kontak }}</td>
                    <td>{{ $data_kontak_darurat->alamat_kontak }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
@else
    <h5 class="text-center">Tidak Ada Data</h5>
@endif
