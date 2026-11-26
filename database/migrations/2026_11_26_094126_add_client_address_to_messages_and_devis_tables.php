<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->text('client_address')->nullable();
        });

        Schema::table('devis', function (Blueprint $table) {
            $table->text('client_address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('devis', function (Blueprint $table) {
            $table->dropColumn('client_address');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('client_address');
        });
    }
};
