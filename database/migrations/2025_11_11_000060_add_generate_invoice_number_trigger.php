<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('orders')) {
            return;
        }
        // Drop existing trigger if exists
        DB::unprepared('DROP TRIGGER IF EXISTS `generate_invoice_number`');

        // Create trigger as in dump
        DB::unprepared(<<<SQL
        CREATE TRIGGER `generate_invoice_number` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
            DECLARE last_num INT;
            SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(invoice_number, '-', -1) AS UNSIGNED)), 0)
              INTO last_num
              FROM orders 
             WHERE DATE(order_date) = DATE(NEW.order_date);
            SET NEW.invoice_number = CONCAT(
                'INV-',
                DATE_FORMAT(NEW.order_date, '%Y%m%d'),
                '-',
                LPAD(last_num + 1, 3, '0')
            );
        END
        SQL);
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `generate_invoice_number`');
    }
};