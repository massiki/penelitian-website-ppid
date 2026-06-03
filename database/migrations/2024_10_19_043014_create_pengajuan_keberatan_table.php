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
        Schema::create('pengajuan_keberatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('no_telepon');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->text('tujuan_penggunaan_informasi');
            $table->foreignId('alasan_pengajuan_id')->constrained(
                table: 'references', indexName: 'pengajuan'
            );
            $table->foreignId('status_id')->default(2)->constrained(
                table: 'status', indexName: 'pengajuan_status'
            );
            $table->text('pesan_ditolak')->nullable();
            $table->string('file_acc_pengajuan')->nullable();
            $table->boolean('status_pengiriman')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_keberatan');
    }
};
