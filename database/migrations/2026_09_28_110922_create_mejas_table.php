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
        Schema::create('mejas', function (Blueprint $table) {
            $table->increments('idmeja');
            $table->string('namameja', 10);
            $table->enum('status', ['kosong', 'terisi'])->default('kosong');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mejas');
    }
};
