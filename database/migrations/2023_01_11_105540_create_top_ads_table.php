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
        Schema::create('top_ads', function (Blueprint $table) {
            $table->id();
            $table->string('ad_title');
            $table->text('about');
            $table->text('service_offered')->nullable();
            $table->text('v_package_details')->nullable();
            $table->String('ad_image')->nullable();
            $table->String('logo_image')->nullable();
            $table->foreignId('category_id')->constrained('vendor_categories')->cascadeOnDelete();
            $table->text('discount_deal')->nullable();
            $table->unsignedInteger('start_price');
            $table->string('v_bus_location');
            $table->json('v_bus_branches')->nullable()->default(NULL);
            // $table->foreignId('v_id')->constrained('vendors')->cascadeOnDelete();
            $table->unsignedBigInteger('v_id');
            $table->foreign('v_id')->references('user_id')->on('vendors')->onDelete('cascade');
            $table->unsignedBigInteger('actual_v_id');
            $table->string('vBusinessName');
            $table->boolean('ad_type')->default(1);
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
        Schema::dropIfExists('top_ads');
    }
};
