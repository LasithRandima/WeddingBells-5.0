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
        Schema::create('site_packages', function (Blueprint $table) {
            $table->id();
            $table->string('pkg_name');
            $table->unsignedInteger('pkg_duration');
            $table->unsignedInteger('pkg_price');
            $table->Text('pkg_description');
            $table->unsignedInteger('image_limit');
            $table->unsignedInteger('ads_limit');
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
        Schema::dropIfExists('site_packages');
    }
};
