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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('v_id')->primary();
            $table->string('v_name');
            $table->string('v_email')->unique();
            $table->string('v_bus_name')->unique();
            $table->text('v-description')->nullable();
            // $table->foreignId('v_category')->constrained('vendor_categories')->cascadeOnDelete();
            $table->json('v_category')->nullable();
            $table->string('v_bus_location');
            $table->json('v_bus_branches')->nullable()->default(NULL);
            $table->string('v_website_url')->unique()->nullable();
            $table->json('v_phone')->nullable()->default(NULL);
            // $table->string('v_tpno2')->unique()->nullable();
            $table->string('map')->nullable();
            // $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('vendors');
    }
};
