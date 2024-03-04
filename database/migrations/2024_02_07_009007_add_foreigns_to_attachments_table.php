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
        Schema::table('attachments', function (Blueprint $table) {
            $table
                ->foreign('extoutbox_id')
                ->references('id')
                ->on('extoutboxes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('intoutbox_id')
                ->references('id')
                ->on('intoutboxes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('inbox_id')
                ->references('id')
                ->on('inboxes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('memo_id')
                ->references('id')
                ->on('memos')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropForeign(['extoutbox_id']);
            $table->dropForeign(['intoutbox_id']);
            $table->dropForeign(['inbox_id']);
            $table->dropForeign(['memo_id']);
        });
    }
};
