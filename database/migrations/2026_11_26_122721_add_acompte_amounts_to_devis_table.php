<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('devis', 'acompte')) {
            Schema::table('devis', function (Blueprint $table) {
                $table->decimal('acompte', 10, 2)->default(0);
            });
        }

        if (!Schema::hasColumn('devis', 'reste_a_payer')) {
            Schema::table('devis', function (Blueprint $table) {
                $table->decimal('reste_a_payer', 10, 2)->default(0);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('devis', 'reste_a_payer')) {
            Schema::table('devis', function (Blueprint $table) {
                $table->dropColumn('reste_a_payer');
            });
        }

        if (Schema::hasColumn('devis', 'acompte')) {
            Schema::table('devis', function (Blueprint $table) {
                $table->dropColumn('acompte');
            });
        }
    }
};

