<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('service_configs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('devis_id');
        $table->json('data');
        $table->timestamps();

        $table->foreign('devis_id')
              ->references('id')
              ->on('devis')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_configs');
    }
};
