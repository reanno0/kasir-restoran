<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_buat_transaksi');

        DB::unprepared(<<<'SQL'
CREATE PROCEDURE sp_buat_transaksi(
    IN p_idpesanan INT,
    IN p_bayar INT
)
BEGIN
    DECLARE v_total INT;

    SELECT SUM(menus.harga * detail_pesanans.jumlah) INTO v_total
    FROM detail_pesanans
    JOIN menus ON menus.idmenu = detail_pesanans.idmenu
    WHERE detail_pesanans.idpesanan = p_idpesanan;

    INSERT INTO transaksis (idpesanan, total, bayar)
    VALUES (p_idpesanan, v_total, p_bayar);

    SELECT v_total AS total, (p_bayar - v_total) AS kembalian;
END
SQL);
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_buat_transaksi');
    }
};