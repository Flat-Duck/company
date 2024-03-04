<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('extoutboxes', function (Blueprint $table) {
            $table
                ->foreign('main_folder_id')
                ->references('id')
                ->on('main_folders')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('sub_folder_id')
                ->references('id')
                ->on('sub_folders')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extoutboxes', function (Blueprint $table) {
            $table->dropForeign(['main_folder_id']);
            $table->dropForeign(['sub_folder_id']);
        });
    }
};
