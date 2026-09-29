<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_buat_transaksi');

        DB::unprepared("
        CREATE PROCEDURE sp_buat_transaksi(
            IN p_idpesanan INT,
            IN p_bayar INT
        )
        BEGIN
            DECLARE v_total INT;

            SELECT SUM(menu.harga * detail_pesanan.jumlah) INTO v_total
            FROM detail_pesanan
            JOIN menu ON menu.idmenu = detail_pesanan.idmenu
            WHERE detail_pesanan.idpesanan = p_idpesanan;

            INSERT INTO transaksi (idpesanan, total, bayar)
            VALUES (p_idpesanan, v_total, p_bayar);

            SELECT v_total AS total, (p_bayar - v_total) AS kembalian;
        END
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_buat_transaksi');
    }
};
