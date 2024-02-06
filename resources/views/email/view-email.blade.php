{{-- 
<p>Yth. {{ $data_email['nama_pelamar'] }},</p>

<p>Status lamaran pada sudah dipindahkan ke {{ Str::title($data_email['status']) }}</p>

<p>Terima kasih atas perhatiannya.</p> --}}


<p>Yth. {{ $data_email['nama_pelamar'] }}</p><br>
<p>Kami ingin memberitahukan kepada Anda tentang perubahan status lamaran Anda untuk posisi
    {{ $data_email['nama_lowongan'] }}. Berikut adalah rincian perubahan status lamaran Anda:</p>
<p>Nama Pelamar: {{ $data_email['nama_pelamar'] }}</p>
<p>Posisi yang Dilamar: {{ $data_email['nama_lowongan'] }}</p>
<p>Tanggal Lamaran:
    {{ \Carbon\Carbon::parse($data_email['tanggal_melamar'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y ') }}
</p>
<p>Status lamaran: {{ Str::title($data_email['status']) }}</p>



@if ($data_email['status'] == 'penawaran')
    <p>Silahkan lihat penawaran yang terdapat pada halaman lamaran saya</p>
@elseif ($data_email['status'] == 'reference check')
    <p>Silahkan isi Application Form pada halaman lamaran saya pada tautan berikut 
        <a href="http://127.0.0.1:8000/profil-kandidat/users/{{ $data_email['slug_pelamar'] }}/application-form/{{ $data_email['slug_lowongan'] }}">Klik disini</a></p>
@endif



<p>Kami menghargai partisipasi Anda dalam proses perekrutan kami dan akan terus menginformasikan perkembangan
    selanjutnya.
    Jika Anda memiliki pertanyaan atau perlu klarifikasi lebih lanjut, jangan ragu untuk menghubungi kami melalui email
    ini.
</p>
<p>Terima kasih atas minat dan waktu Anda untuk melamar di Yayasan SATUNAMA.</p>

<p>Salam,<br>
    {{ $data_email['nama_karyawan'] }}</p>

{{-- Subject: [Nama Perusahaan] - Pemberitahuan Pergantian Status Lamaran

Dear [Nama Pelamar],

Kami ingin memberitahukan kepada Anda tentang perubahan status lamaran Anda untuk posisi [Nama Posisi] di [Nama Perusahaan]. Berikut adalah rincian perubahan status lamaran Anda:

Nama Pelamar: [Nama Pelamar]
Posisi yang Dilamar: [Nama Posisi]
Tanggal Lamaran: [Tanggal Lamaran]

Perubahan Status Lamaran:
Status Lamaran sebelumnya: [Status Lamaran Sebelumnya]
Status Lamaran saat ini: [Status Lamaran Saat Ini]
Tanggal Perubahan Status: [Tanggal Perubahan Status]

Keterangan Tambahan (jika ada): [Keterangan Tambahan, misalnya alasan perubahan status]

Kami menghargai partisipasi Anda dalam proses perekrutan kami dan akan terus menginformasikan perkembangan selanjutnya. Jika Anda memiliki pertanyaan atau perlu klarifikasi lebih lanjut, jangan ragu untuk menghubungi kami melalui email ini.

Terima kasih atas minat dan waktu Anda untuk melamar di [Nama Perusahaan]. Kami berharap Anda sukses dalam pencarian pekerjaan Anda.

Salam,
[Tanda Tangan atau Nama HRD]
[Alamat Email HRD]
[Nomor Telepon HRD]
[Nama Perusahaan] --}}
