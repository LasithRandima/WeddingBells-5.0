<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('c_id')->primary();
            $table->string('c_name');
            $table->string('c_email')->unique();
            $table->string('gender')->nullable();;
            $table->string('partner_name');
            $table->string('partner_email')->unique()->nullable();
            $table->string('c_location');
            $table->json('c_tpno');
            $table->unsignedInteger('guest_count')->nullable();
            $table->date('wed_date')->nullable();
            $table->time('wed_start_time')->nullable();
            $table->time('wed_end_time')->nullable();
            $table->timestamps();
            // $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
