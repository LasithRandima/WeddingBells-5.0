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
        Schema::table('advertisements', function (Blueprint $table) {
            $table->String('meta_title')->nullable();
            $table->MediumText('meta_des')->nullable();
            $table->json('meta_tags')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->String('meta_title')->nullable();
            $table->MediumText('meta_des')->nullable();
            $table->json('meta_tags')->nullable()->default(NULL);
        });
    }
};
