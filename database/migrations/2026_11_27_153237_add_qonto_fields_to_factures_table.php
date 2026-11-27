<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->string('qonto_invoice_id')->nullable()->unique();
            $table->string('qonto_status')->nullable();
            $table->string('qonto_attachment_id')->nullable();
            $table->timestamp('qonto_sent_at')->nullable();
            $table->text('qonto_last_error')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->dropUnique(['qonto_invoice_id']);
            $table->dropColumn([
                'qonto_invoice_id',
                'qonto_status',
                'qonto_attachment_id',
                'qonto_sent_at',
                'qonto_last_error',
            ]);
        });
    }
};