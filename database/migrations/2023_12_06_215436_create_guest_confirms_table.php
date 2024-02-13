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
        Schema::create('guest_confirms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_id');
            $table->foreign('c_id')->references('user_id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('guest_id');
            $table->foreign('guest_id')->references('id')->on('guest_lists')->onDelete('cascade');
            $table->unsignedBigInteger('companion_id');
            $table->foreign('companion_id')->references('id')->on('guest_companions')->onDelete('cascade');
            $table->string('event');
            $table->string('meal');
            $table->string('attendance_status');
            $table->boolean('c_is_drink')->default(0);
            $table->mediumText('guest_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_confirms');
    }
};
