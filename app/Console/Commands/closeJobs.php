<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Lowongan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendNotificationCloseJobSoon;

class closeJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'close:jobClose';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim email jika lowongan akan ditutup dalam 2 hari.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lowonganSegeraTutup = Lowongan::where('tanggal_tutup', now()->addDays(2))->get();
        $userAdmin = User::where('role', 'admin')->get();

        if ($lowonganSegeraTutup) {
            foreach ($lowonganSegeraTutup as $lowongan) {
                $data_email = [
                    'nama_lowongan' => $lowongan->nama_lowongan,
                    'tanggal_tutup' => $lowongan->tanggal_tutup,
                ];

                foreach ($userAdmin as $user) {
                    Mail::to($user->email)->send(new sendNotificationCloseJobSoon($data_email));
                }
            }
        } else {
            $this->info('Tidak ada lowongan yang tutup dalam dua hari kedepan');
        }
    }
}
