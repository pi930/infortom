<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('factures', function (Blueprint $table) {

            $table->decimal('montant_ht', 10, 2)
                ->after('type')
                ->nullable();

            $table->decimal('montant_ttc', 10, 2)
                ->after('montant_ht')
                ->nullable();

            $table->decimal('tva', 10, 2)
                ->default(0)
                ->after('montant_ttc');

            $table->boolean('email_envoye')
                ->default(false)
                ->after('date_facture');

            $table->timestamp('email_envoye_le')
                ->nullable()
                ->after('email_envoye');
        });
    }

    public function down(): void
    {
        Schema::table('factures', function (Blueprint $table) {

            $table->dropColumn([
                'montant_ht',
                'montant_ttc',
                'tva',
                'email_envoye',
                'email_envoye_le',
            ]);
        });
    }
};
