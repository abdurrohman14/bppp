<?php

namespace App\Console\Commands;

use App\Models\JadwalPakan;
use Illuminate\Console\Command;
use App\Models\User;

class SendPakanReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-pakan-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jadwalPakan = JadwalPakan::with('spesies')->get();
        $fonnteService = new \App\Services\FonteServices();

        $users = User::whereNotNull('whatsapp')->where('role_id', 1)->get();
        foreach ($jadwalPakan as $pakan) {
            foreach ($users as $user) {
                try {
                    $phone = $this->formatPhoneNumber($user->whatsapp);
                    $pesan = $pakan->formatPesan();

                    $this->info("Mengirim ke {$phone} (User: {$user->name}):");
                    $this->line($pesan);

                    $response = $fonnteService->sendWhatsapp($phone, $pesan);

                    if ($response && $response['status'] ?? false) {
                        $this->info("✅ Sukses: " . $response['message'] ?? 'Terkirim');
                    } else {
                        $this->error("❌ Gagal: " . ($response['message'] ?? 'Unknown error'));
                        $this->error("Detail: " . json_encode($response));
                    }
                } catch (\Exception $e) {
                    $this->error("🔥 Error untuk user {$user->name}: " . $e->getMessage());
                }
            }
        }
    }

    /**
     * Format nomor telepon ke format yang benar (62...)
     *
     * @param string $phone
     * @return string
     */
    protected function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (empty($phone)) {
            throw new \Exception("Nomor telepon kosong");
        }

        // Jika sudah format 62...
        if (strpos($phone, '62') === 0) {
            return $phone;
        }

        // Jika format 08...
        if (strpos($phone, '0') === 0) {
            return '62' . substr($phone, 1);
        }

        throw new \Exception("Format nomor tidak valid");
    }
}
