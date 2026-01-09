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
    DB::table('users')
        ->whereNull('phone')
        ->update(['phone' => '0000000000']); // valeur temporaire
}

public function down()
{
    // rien à faire
}

};
