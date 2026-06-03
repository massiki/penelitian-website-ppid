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
        Schema::create('informasi_publik_details', function (Blueprint $table) {
            $table->id();
            $table->text('informasi');
            $table->integer('tahun');
            $table->foreignId('informasi_publik_id')->constrained(
                table: 'informasi_publik', indexName: 'details'
            );
            $table->string('link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_publik_details');
    }
};
