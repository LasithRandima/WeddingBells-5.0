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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->constrained('advertisements')->cascadeOnDelete();
            // $table->foreignId('v_id')->constrained('vendors')->cascadeOnDelete();
            $table->unsignedBigInteger('v_id');
            $table->foreign('v_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('actual_v_id');
            $table->foreign('actual_v_id')->references('id')->on('vendors')->onDelete('cascade');

            // $table->foreignId('c_id')->constrained('clients')->cascadeOnDelete();
            $table->unsignedBigInteger('c_id');
            $table->foreign('c_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('actual_c_id');
            $table->foreign('actual_c_id')->references('id')->on('clients')->onDelete('cascade');
            $table->text('review');
            $table->unsignedTinyInteger('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
