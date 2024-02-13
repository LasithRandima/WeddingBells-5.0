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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->string('payer_id');
            $table->string('payer_email');
            $table->unsignedBigInteger('v_id');
            $table->foreign('v_id')->references('user_id')->on('vendors')->onDelete('cascade');
            $table->unsignedBigInteger('actual_v_id');
            $table->foreign('actual_v_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->string('v_email');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('site_packages')->onDelete('cascade');
            $table->float('amount', 10, 2);
            $table->string('currency');
            $table->string('payment_status');
            $table->unsignedInteger('image_count');
            $table->unsignedInteger('ads_count');
            $table->unsignedInteger('top_ads_count');
            $table->date('package_expire')->default(now()->addYear());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
