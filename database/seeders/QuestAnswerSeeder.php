<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quest_answers')->insert([
            [
                'judul' => 'Apa itu ppid?',
                'deskripsi' => 'PPID atau Pejabat Pengelola Informasi dan Dokumentasi adalah pejabat yang bertanggung jawab dalam
                    pengelolaan informasi publik di instansi pemerintah. PPID bertugas untuk mengumpulkan,
                    mendokumentasikan, menyediakan, dan/atau menyebarluaskan informasi publik sesuai dengan peraturan
                    perundang-undangan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Apa saja informasi yang dapat diakses melalui PPID?',
                'deskripsi' => 'Informasi yang dapat diakses melalui PPID meliputi informasi yang bersifat terbuka untuk publik,
                    seperti laporan keuangan, laporan tahunan, program dan kegiatan instansi, serta informasi lainnya yang
                    terkait dengan layanan publik. Namun, beberapa informasi yang bersifat rahasia, seperti data pribadi
                    dan informasi yang dapat membahayakan keamanan negara, tidak dapat diakses.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Bagaimana cara mengajukan permohonan informasi ke PPID?',
                'deskripsi' => 'Pemohon dapat mengajukan permohonan informasi melalui portal resmi PPID, dengan mengisi formulir
                    permohonan yang disediakan. Permohonan juga dapat diajukan secara langsung ke kantor PPID terkait.
                    Dalam permohonan, pemohon harus mencantumkan identitas lengkap dan jenis informasi yang ingin
                    diperoleh.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Berapa lama proses penyampaian informasi oleh PPID?',
                'deskripsi' => 'Setelah menerima permohonan informasi, PPID memiliki waktu maksimal 10 hari kerja untuk
                    memberikan tanggapan. Jika dibutuhkan waktu tambahan, PPID dapat memperpanjang waktu tersebut hingga 7
                    hari kerja berikutnya, dengan memberikan pemberitahuan resmi kepada pemohon mengenai alasan
                    perpanjangan waktu tersebut.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
