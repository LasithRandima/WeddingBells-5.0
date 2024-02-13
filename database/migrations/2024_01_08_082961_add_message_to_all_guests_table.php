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
        Schema::table('all_guests', function (Blueprint $table) {
            $table->mediumText('invite_msg')->after('notes')->nullable();
            $table->string('select_meal')->after('invite_msg')->nullable();
            $table->string('mail_status')->after('select_meal')->default('not_send')->nullable();
            $table->timestamp('mail_sent_at')->after('mail_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_guests', function (Blueprint $table) {
            $table->dropColumn('invite_msg');
            $table->dropColumn('select_meal');
            $table->dropColumn('mail_status');
            $table->dropColumn('mail_sent_at');
        });
    }
};
