<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {

    $table->id();

    $table->foreignId('devis_id')
        ->constrained()
        ->cascadeOnDelete();

    // FAC-2026-0001
    $table->string('numero')->unique();

    $table->enum('type', [
        'acompte',
        'solde',
        'totale'
    ]);

    $table->decimal('montant_ht', 10, 2);
    $table->decimal('montant_ttc', 10, 2);

    $table->decimal('tva', 10, 2)->default(0);

    $table->string('pdf_path')->nullable();

    $table->timestamp('date_facture');

    // envoyé automatiquement au client ?
    $table->boolean('email_envoye')->default(false);

    // date réelle d'envoi
    $table->timestamp('email_envoye_le')->nullable();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
