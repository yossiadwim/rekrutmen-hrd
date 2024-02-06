<nav class="navbar navbar-expand-lg border shadow">
    <div class="container ">
        <a class="navbar-brand" href="/main"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <img class="" src="{{ asset('img/satunama-logo.png') }}" alt="logo" width="70" height="70">

            @can('admin')
                <ul class="navbar-nav mx-5">
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/admin-dashboard/lowongan">Dashboard</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link fw-bold" href="/admin-dashboard/">Kelola kandidat</a>
                    </li> --}}
                </ul>
            @elsecan('user')
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold" href="/lowongan-kerja">Lowongan Kerja</a>
                    </li>
                </ul>
            @endcan


            <ul class="navbar-nav ms-auto mx-5">
                @auth

                    @can('user')
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#notifikasi_user" aria-controls="offcanvasScrolling"
                            style="background-color: #ffffff; border: 0"><i class="fa-solid fa-bell bell"
                                style="color: #000000;"></i>
                            <span class="translate-middle badge rounded-pill bg-primary" style="background-color: #008800">
                                {{ count($notifikasi_unread) }}
                                <span class="visually-hidden">unread messages</span>
                            </span></button>
                            
                    @elsecan('admin')
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#notifikasi_admin" aria-controls="offcanvasScrolling"
                            style="background-color: #ffffff; border: 0"><i class="fa-solid fa-bell"
                                style="color: #000000;"></i>
                            <span class="translate-middle badge rounded-pill bg-primary">
                                @isset($notifikasi_unread)
                                    @php
                                        $totalCount = 0;
                                        foreach ($notifikasi_unread as $item) {
                                            if (!is_null($item)) {
                                                $totalCount += count($item);
                                            }
                                        }
                                    @endphp
                                    {{ $totalCount }}
                                @else
                                    0
                                @endisset
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                    @endcan


                    <div class="dropdown-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  text-dark" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->id_pelamar == null ? auth()->user()->karyawan->nama_karyawan : auth()->user()->pelamar->nama_pelamar }}
                            </a>

                            @can('user')
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item mb-2" href="/profil-kandidat/users/{{ $user->uuid }}"
                                            id="profil-dropdown" role="button"><i class="fa-solid fa-circle-user"></i>
                                            Profil</a></li>
                                    <li><a class="dropdown-item mb-2"
                                            href="/lamaran-saya/{{ $user->uuid }}"><i
                                                class="fa-solid fa-file-lines"></i>
                                            Lamaran Saya</a></li>
                                    <li><a class="dropdown-item mb-2"
                                            href="/pengaturan-akun/{{ $user->uuid }}"><i
                                                class="fa-solid fa-gear"></i>
                                            Pengaturan Akun</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="/logout" method="post">
                                            @csrf
                                            <input type="text" name="id_karyawan" id="id_karyawan"
                                                value="{{ $user->id_karyawan }}" hidden>
                                            <input type="text" name="id_pelamar" id="id_pelamar"
                                                value="{{ $user->id_pelamar }}" hidden>

                                            <button type="submit" class="dropdown-item"><i
                                                    class="fa-solid fa-right-from-bracket" style="color: #000000;"></i>
                                                Keluar</button>
                                        </form>

                                    </li>
                                </ul>
                            @elsecan('admin')
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <li><a class="dropdown-item mb-2" href="/pengaturan"><i class="fa-solid fa-gear"
                                                style="color: #000000;"></i>
                                            Pengaturan Akun</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="/logout" method="post">
                                            @csrf
                                            <input type="text" name="id_karyawan" id="id_karyawan"
                                                value="{{ $user == null ? '' : $user->id_karyawan }}" hidden>
                                            <input type="text" name="id_pelamar" id="id_pelamar"
                                                value="{{ $user == null ? '' : $user->pelamar }}" hidden>

                                            <button type="submit" class="dropdown-item"><i
                                                    class="fa-solid fa-right-from-bracket" style="color: #000000;"></i>
                                                Keluar</button>
                                        </form>

                                    </li>
                                </ul>
                            @endcan

                        </li>
                    </div>
                @else
                    <li class="nav-item">
                        <a href="/login" class="nav-link">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
