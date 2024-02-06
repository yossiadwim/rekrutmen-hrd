<?php

namespace App\Console\Commands;

use App\Models\Lowongan;
use Illuminate\Console\Command;

class CloseJobsOnTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'close:closeJobOnTheDay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menutup lowongan sesuai dengan tanggal tutup';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lowongan_tutup = Lowongan::where('tanggal_tutup', now())->get();


        if ($lowongan_tutup == null) {
            $this->info("Tidak ada lowongan tutup hari ini");
        } else {
            $this->info('Ada Lowongan tutup hari ini');
            $data = [
                'closed' => true,
            ];
            foreach ($lowongan_tutup as $lowongan) {
                Lowongan::where('id', $lowongan->id)->update($data);
            }
        }
    }
}
