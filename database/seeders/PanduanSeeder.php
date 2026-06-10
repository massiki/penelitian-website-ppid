<?php

namespace Database\Seeders;

use App\Models\Panduan;
use Illuminate\Database\Seeder;

class PanduanSeeder extends Seeder
{
    public function run(): void
    {
        Panduan::create([
            'slug' => 'permohonan',
            'judul' => 'Panduan Permohonan Informasi',
            'deskripsi' => 'Pelajari alur dan persyaratan sebelum mengajukan permohonan informasi publik.',
            'video_url' => 'https://ppid-simonik.bandung.go.id/assets/img/videomekanismepelayanan.mp4',
            'deskripsi_konten' => 'Permohonan Informasi adalah layanan yang diberikan kepada masyarakat untuk memperoleh informasi publik yang berada di bawah penguasaan RSUD Kesehatan Kerja sesuai dengan peraturan perundang-undangan yang berlaku.',
            'persyaratan' => [
                'Mengisi data-data pribadi.',
                'Foto Kartu Tanda Penduduk (KTP) yang masih berlaku.',
                'Informasi yang ingin diminta secara jelas dan rinci.',
                'Email atau nomor telepon yang dapat dihubungi.',
            ],
            'langkah' => [
                [
                    'judul' => 'Klik Menu Permohonan Informasi',
                    'deskripsi' => 'Klik menu <strong>Permohonan &rarr; Permohonan Informasi</strong> pada website PPID.',
                    'fields' => null,
                ],
                [
                    'judul' => 'Isi Formulir Permohonan',
                    'deskripsi' => 'Isi formulir permohonan informasi dengan lengkap dan benar.',
                    'fields' => ['Nama Lengkap', 'Email', 'Nomor Telepon', 'Pekerjaan', 'Alamat', 'NIK', 'Foto KTP', 'Informasi yang Dibutuhkan', 'Alasan Penggunaan Informasi'],
                ],
                [
                    'judul' => 'Kirim Permohonan',
                    'deskripsi' => 'Periksa kembali data yang telah diisi kemudian klik tombol <strong>Kirim Permohonan</strong>.',
                    'fields' => null,
                ],
                [
                    'judul' => 'Verifikasi oleh Petugas',
                    'deskripsi' => 'Petugas PPID akan melakukan verifikasi data dan memproses permohonan informasi sesuai ketentuan yang berlaku.',
                    'fields' => null,
                ],
            ],
            'status_list' => [
                'Terkirim', 'Diproses', 'Diterima', 'Ditolak', 'Selesai',
            ],
            'is_active' => true,
        ]);

        Panduan::create([
            'slug' => 'pengajuan',
            'judul' => 'Panduan Pengajuan Keberatan',
            'deskripsi' => 'Pelajari alur, alasan, dan status dalam mengajukan keberatan informasi publik apabila Anda tidak puas terhadap hasil permohonan informasi yang telah diberikan oleh PPID.',
            'video_url' => 'https://ppid-simonik.bandung.go.id/assets/img/videomekanismepelayanan.mp4',
            'deskripsi_konten' => 'Pengajuan keberatan merupakan layanan yang diberikan kepada pemohon informasi apabila tidak puas terhadap hasil permohonan informasi yang telah diberikan oleh PPID.',
            'persyaratan' => [
                'Permohonan informasi ditolak.',
                'Informasi yang diberikan tidak sesuai dengan yang diminta.',
                'Informasi yang diberikan tidak lengkap.',
                'Permohonan tidak ditanggapi dalam jangka waktu yang ditentukan.',
                'Terjadi kendala lain dalam pelayanan informasi publik.',
            ],
            'langkah' => [
                [
                    'judul' => 'Pastikan Permohonan Informasi Ditolak',
                    'deskripsi' => 'Pastikan Permohonan Informasi Anda ditolak untuk mengisi formulir pengajuan keberatan terhadap permohonan informasi sebelumnya yang diminta.',
                    'fields' => null,
                ],
                [
                    'judul' => 'Pilih Menu Permohonan &rarr; Pengajuan Keberatan',
                    'deskripsi' => 'Pilih menu <strong>Permohonan &rarr; Pengajuan Keberatan</strong>.',
                    'fields' => null,
                ],
                [
                    'judul' => 'Isi Formulir Keberatan',
                    'deskripsi' => 'Isi formulir keberatan dengan lengkap.',
                    'fields' => ['Nama Lengkap', 'Email', 'No Telephone', 'Pekerjaan', 'Alamat', 'Alasan Pengajuan Keberatan', 'Tujuan Penggunaan Informasi'],
                ],
                [
                    'judul' => 'Kirim Keberatan',
                    'deskripsi' => 'Klik tombol <strong>Kirim Keberatan</strong>.',
                    'fields' => null,
                ],
                [
                    'judul' => 'Pemeriksaan oleh Petugas',
                    'deskripsi' => 'Petugas PPID akan melakukan pemeriksaan dan verifikasi terhadap pengajuan keberatan yang diajukan terhadap permohonan informasi sebelumnya.',
                    'fields' => null,
                ],
            ],
            'status_list' => [
                'Terkirim', 'Diproses', 'Diterima', 'Ditolak', 'Selesai',
            ],
            'is_active' => true,
        ]);
    }
}
