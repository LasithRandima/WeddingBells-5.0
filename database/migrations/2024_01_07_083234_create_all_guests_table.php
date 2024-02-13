<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('all_guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_id');
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->unsignedBigInteger('companion_id')->nullable();
            $table->string('g_first_name');
            $table->string('g_last_name')->nullable();
            $table->string('age')->nullable();
            $table->string('email')->nullable();
            $table->string('tp_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->json('invited_to')->nullable();
            $table->string('ceremony')->default('Pending');
            $table->string('evening_reception')->default('Pending');
            $table->string('wedding_breakfast')->default('Pending');
            $table->string('other')->default('Pending');
            $table->string('guest_group')->nullable();
            $table->boolean('is_drink')->default(0);
            $table->boolean('is_invited')->default(0);
            $table->boolean('is_companion')->default(0);
            $table->mediumText('notes')->nullable();
            $table->timestamps();
            });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_guests');
    }
};
