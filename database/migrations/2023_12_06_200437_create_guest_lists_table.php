<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guest_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_id');
            $table->foreign('c_id')->references('user_id')->on('clients')->onDelete('cascade');
            $table->string('g_first_name');
            $table->string('g_last_name')->nullable();
            $table->string('age')->nullable();
            $table->string('email')->nullable();
            $table->string('tp_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->json('invited_to')->nullable();
            $table->string('ceremony')->default('Pending');
            $table->string('evening_reception')->default('Pending');
            $table->string('wedding_breakfast')->default('Pending');
            $table->string('other')->default('Pending');

            // $table->boolean('ceremony')->default(0);
            // $table->boolean('evening_reception')->default(0);
            // $table->boolean('wedding_breakfast')->default(0);
            // $table->boolean('other')->default(0);

            $table->string('guest_group')->nullable();
            $table->boolean('is_drink')->default(0);
            $table->boolean('is_invited')->default(0);
            $table->boolean('is_companion')->default(0);
            $table->mediumText('notes')->nullable();
            $table->timestamps();
        });



                // Create trigger for INSERT on guest_lists
                DB::unprepared('
                CREATE TRIGGER tr_insert_guest_list
                AFTER INSERT
                ON guest_lists
                FOR EACH ROW
                BEGIN
                    -- Insert into all_guests table
                    INSERT INTO all_guests (c_id, guest_id, g_first_name, g_last_name, age, email, tp_no, mobile_no, address, invited_to, ceremony, evening_reception, wedding_breakfast, other, guest_group, is_drink, is_invited, is_companion, notes, created_at, updated_at)
                    VALUES (NEW.c_id, NEW.id, NEW.g_first_name, NEW.g_last_name, NEW.age, NEW.email, NEW.tp_no, NEW.mobile_no, NEW.address, NEW.invited_to, NEW.ceremony, NEW.evening_reception, NEW.wedding_breakfast, NEW.other, NEW.guest_group, NEW.is_drink, NEW.is_invited, 0, NEW.notes, NOW(), NOW());
                END
            ');

            // Create trigger for UPDATE on guest_lists
            DB::unprepared('
                CREATE TRIGGER tr_update_guest_list
                AFTER UPDATE
                ON guest_lists
                FOR EACH ROW
                BEGIN
                    -- Update corresponding row in all_guests table
                    UPDATE all_guests
                    SET c_id = NEW.c_id,
                        guest_id = NEW.id,
                        g_first_name = NEW.g_first_name,
                        g_last_name = NEW.g_last_name,
                        age = NEW.age,
                        email = NEW.email,
                        tp_no = NEW.tp_no,
                        mobile_no = NEW.mobile_no,
                        address = NEW.address,
                        invited_to = NEW.invited_to,
                        ceremony = NEW.ceremony,
                        evening_reception = NEW.evening_reception,
                        wedding_breakfast = NEW.wedding_breakfast,
                        other = NEW.other,
                        `guest_group` = NEW.guest_group,
                        is_drink = NEW.is_drink,
                        is_invited = NEW.is_invited,
                        is_companion = 0,
                        notes = NEW.notes,
                        updated_at = NOW()
                    WHERE guest_id = NEW.id;
                END
            ');

            // Create trigger for DELETE on guest_lists
            DB::unprepared('
                CREATE TRIGGER tr_delete_guest_list
                AFTER DELETE
                ON guest_lists
                FOR EACH ROW
                BEGIN
                    -- Delete corresponding row from all_guests table
                    DELETE FROM all_guests WHERE guest_id = OLD.id;
                END
            ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_lists');
    }
};
