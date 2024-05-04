<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('intoutboxes', function (Blueprint $table) {
            $table->dropForeign(['main_folder_id']);
            $table->dropColumn('main_folder_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intoutboxes', function (Blueprint $table) {
            //
        });
    }
};
