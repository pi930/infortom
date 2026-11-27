<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->boolean('is_company')->default(false);
            $table->string('company_name')->nullable();
            $table->string('company_siren', 9)->nullable();
            $table->string('company_vat_number')->nullable();
        });

        Schema::table('devis', function (Blueprint $table) {
            $table->boolean('is_company')->default(false);
            $table->string('company_name')->nullable();
            $table->string('company_siren', 9)->nullable();
            $table->string('company_vat_number')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn([
                'is_company',
                'company_name',
                'company_siren',
                'company_vat_number',
            ]);
        });

        Schema::table('devis', function (Blueprint $table) {
            $table->dropColumn([
                'is_company',
                'company_name',
                'company_siren',
                'company_vat_number',
            ]);
        });
    }
};
