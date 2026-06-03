<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonan_informasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('no_telepon');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->char('nik', 16);
            $table->string('file_ktp');
            $table->text('informasi_yang_dibutuhkan');
            $table->text('alasan_penggunaan_informasi');
            $table->foreignId('memperoleh_informasi_id')->constrained(
                table: 'references', indexName: 'memperoleh'
            );
            $table->foreignId('mendapatkan_salinan_informasi_id')->constrained(
                table: 'references', indexName: 'mendapat'
            );
            $table->foreignId('status_id')->default(2)->constrained(
                table: 'status', indexName: 'permohonan_status'
            );
            $table->text('pesan_ditolak')->nullable();
            $table->string('file_acc_permohonan')->nullable();
            $table->boolean('status_pengiriman')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_informasi');
    }
};
