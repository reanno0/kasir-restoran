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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->increments('idpesanan');
            $table->unsignedInteger('idpelanggan');
            $table->unsignedInteger('idmeja');
            $table->unsignedInteger('iduser');

            $table->foreign('idpelanggan')->references('idpelanggan')->on('pelanggans');
            $table->foreign('idmeja')->references('idmeja')->on('mejas');
            $table->foreign('iduser')->references('iduser')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
