@if (in_array($data->pelamar->id, $anakId))
    <table class="table " id="tableAnak">
        <thead class="">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Anak</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Umur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->pelamar->anakPelamar as $index => $data_anak_pelamar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data_anak_pelamar->nama_anak }}</td>
                    <td>{{ $data_anak_pelamar->jenis_kelamin_anak }}</td>
                    <td>{{ $data_anak_pelamar->umur_anak }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h5 class="text-center">Tidak Ada Data </h5>
@endif
