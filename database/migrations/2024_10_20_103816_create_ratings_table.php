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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('star');
            $table->string('comment');
            $table->foreignId('permohonan_informasi_id')->nullable()->constrained(
                table: 'permohonan_informasi', indexName: 'rating_permohonan'
            );
            // $table->foreignId('pengajuan_keberatan_id')->nullable()->constrained(
            //     table: 'pengajuan_keberatan', indexName: 'rating_pengajuan'
            // );
            $table->integer('status_post')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
