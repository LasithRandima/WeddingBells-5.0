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
        Schema::create('vendor_faqs', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('v_id')->constrained('vendors')->cascadeOnDelete();
            $table->unsignedBigInteger('v_id');
            $table->foreign('v_id')->references('user_id')->on('vendors')->onDelete('cascade');
            $table->text('Question');
            $table->text('Answer');
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
        Schema::dropIfExists('vendor_faqs');
    }
};
