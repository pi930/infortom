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

            $table->string('numero')->unique();

            $table->enum('type', [
                'acompte',
                'solde',
                'totale'
            ]);

            $table->decimal('montant', 10, 2);

            $table->string('pdf_path')->nullable();

            $table->timestamp('date_facture');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
