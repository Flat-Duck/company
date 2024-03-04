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
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('file')->nullable();
            $table->unsignedBigInteger('extoutbox_id');
            $table->unsignedBigInteger('intoutbox_id');
            $table->unsignedBigInteger('inbox_id');
            $table->unsignedBigInteger('memo_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
