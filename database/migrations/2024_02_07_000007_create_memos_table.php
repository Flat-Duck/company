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
        Schema::create('memos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->date('registered_at');
            $table->timestamp('issued_at');
            $table->string('type');
            $table->text('subject');
            $table->unsignedBigInteger('main_folder_id');
            $table->unsignedBigInteger('sub_folder_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memos');
    }
};
