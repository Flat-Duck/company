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
        Schema::create('extoutboxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->timestamp('registered_at');
            $table->timestamp('issued_at');
            $table->string('sender');
            $table->string('receiver');
            $table->text('subject');
            $table
                ->enum('company_status', ['قائمة', 'قيد التشطيب', 'تم شطبها'])
                ->default('قائمة')
                ->nullable();
            $table->unsignedBigInteger('main_folder_id');
            $table->unsignedBigInteger('sub_folder_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extoutboxes');
    }
};
