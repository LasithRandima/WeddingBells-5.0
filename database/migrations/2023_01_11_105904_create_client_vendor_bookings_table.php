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
        Schema::create('client_vendor_bookings', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('c_id')->constrained('clients')->cascadeOnDelete();
            $table->unsignedBigInteger('c_id');
            $table->foreign('c_id')->references('user_id')->on('clients')->onDelete('cascade');

            $table->foreignId('ad_id')->constrained('advertisements')->cascadeOnDelete()->nullable();
            // $table->foreignId('top_ad_id')->constrained('top_ads')->cascadeOnDelete()->nullable();


            // $table->foreignId('v_id')->constrained('vendors')->cascadeOnDelete();
            $table->unsignedBigInteger('v_id')->nullable();
            // $table->foreign('v_id')->references('user_id')->on('vendors')->onDelete('cascade');
            $table->foreign('v_id')->references('id')->on('vendors')->onDelete('cascade');

            $table->unsignedBigInteger('categoryid')->nullable();
            $table->foreign('categoryid')->references('id')->on('vendor_categories')->onDelete('cascade');

            $table->string('c_name');
            $table->string('c_email');
            $table->string('c_tpno');
            $table->text('message')->nullable();
            $table->unsignedBigInteger('pkg_id')->nullable();
            $table->date('event_date');
            $table->time('event_start_time');
            $table->time('event_end_time')->nullable();
            $table->string('booking_status')->nullable();
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
        Schema::dropIfExists('client_vendor_bookings');
    }
};
