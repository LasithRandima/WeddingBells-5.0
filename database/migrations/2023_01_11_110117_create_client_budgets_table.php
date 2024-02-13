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
        Schema::create('client_budgets', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('c_id')->constrained('users')->cascadeOnDelete();
            // $table->foreignId('c_id')->constrained('clients')->cascadeOnDelete();
            $table->unsignedBigInteger('c_id');
            $table->foreign('c_id')->references('user_id')->on('clients')->onDelete('cascade');
            $table->string('exp_name');
            $table->string('exp_category');
            $table->unsignedInteger('estimated_cost');
            $table->unsignedInteger('final_cost')->nullable();
            $table->unsignedInteger('advance_paid')->nullable();
            $table->date('advance_paid_date')->nullable();
            $table->unsignedInteger('amount_to_be_paid')->nullable();
            $table->date('final_cost_paid_date')->nullable();
            $table->string('paid_person_name')->nullable();;
            $table->boolean('has_paid')->default(0);
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
        Schema::dropIfExists('client_budgets');
    }
};
