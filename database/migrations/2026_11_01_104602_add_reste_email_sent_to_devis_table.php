<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('devis', function (Blueprint $table) {
        if (!Schema::hasColumn('devis', 'reste_email_sent')) {
            $table->boolean('reste_email_sent')->default(false);
        }
    });
}

public function down(): void
{
    Schema::table('devis', function (Blueprint $table) {
        $table->dropColumn('reste_email_sent');
    });
}
};
