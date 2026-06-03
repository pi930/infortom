<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('devis', function (Blueprint $table) {
    if (!Schema::hasColumn('devis', 'total_ht')) {
        $table->decimal('total_ht', 8, 2)->nullable();
    }
    if (!Schema::hasColumn('devis', 'tva')) {
        $table->decimal('tva', 8, 2)->nullable();
    }
    if (!Schema::hasColumn('devis', 'total_ttc')) {
        $table->decimal('total_ttc', 8, 2)->nullable();
    }
    if (!Schema::hasColumn('devis', 'acompte_possible')) {
        $table->boolean('acompte_possible')->default(false);
    }
    if (!Schema::hasColumn('devis', 'paiement_type')) {
        $table->string('paiement_type')->nullable();
    }
    if (!Schema::hasColumn('devis', 'paiement_date')) {
        $table->timestamp('paiement_date')->nullable();
    }
});

    }

    public function down(): void
    {
        Schema::table('devis', function (Blueprint $table) {
            $table->dropColumn([
                'total_ht',
                'tva',
                'total_ttc',
                'acompte_possible',
                'paiement_type',
                'paiement_date',
            ]);
        });
    }
};

