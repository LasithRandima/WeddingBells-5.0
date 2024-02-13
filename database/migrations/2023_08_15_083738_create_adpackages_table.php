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
        Schema::create('adpackages', function (Blueprint $table) {
            $table->id();
            $table->string('pkg_name');
            $table->text('pkg_description');
            $table->string('price');
            // $table->unsignedBigInteger('ad_id');
            // $table->string('ad_title')->nullable();
            $table->unsignedBigInteger('v_id');
            $table->foreign('v_id')->references('user_id')->on('vendors')->onDelete('cascade');
            $table->unsignedBigInteger('actual_v_id');
            $table->string('v_bus_name');
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
        Schema::dropIfExists('adpackages');
    }
};
