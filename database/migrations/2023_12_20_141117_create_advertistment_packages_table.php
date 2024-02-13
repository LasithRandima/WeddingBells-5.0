<?php

use App\Models\Adpackage;
use App\Models\Advertisement;
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
        Schema::create('advertistment_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Advertisement::class);
            $table->foreignIdFor(Adpackage::class);
            $table->unsignedTinyInteger('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertistment_packages');
    }
};
