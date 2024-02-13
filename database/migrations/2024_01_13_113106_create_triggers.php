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
        Schema::table('guest_confirms', function (Blueprint $table) {
           // Trigger for inserting into guest_confirms
           DB::unprepared('
           CREATE TRIGGER after_insert_guest_confirms
           AFTER INSERT ON guest_confirms
           FOR EACH ROW
           BEGIN
               IF NEW.attendance_status IN (\'Accept\', \'Reject\', \'Pending\') THEN
                   UPDATE all_guests
                   SET
                       ceremony = CASE WHEN NEW.event = \'ceremony\' THEN NEW.attendance_status ELSE ceremony END,
                       evening_reception = CASE WHEN NEW.event = \'evening_reception\' THEN NEW.attendance_status ELSE evening_reception END,
                       wedding_breakfast = CASE WHEN NEW.event = \'wedding_breakfast\' THEN NEW.attendance_status ELSE wedding_breakfast END,
                       other = CASE WHEN NEW.event = \'other\' THEN NEW.attendance_status ELSE other END,
                       is_drink = NEW.c_is_drink,
                       select_meal = NEW.meal
                   WHERE id = NEW.guest_id;
               END IF;
           END;
       ');

       DB::unprepared('
       CREATE TRIGGER after_insert_guest_confirms
       AFTER INSERT ON guest_confirms
       FOR EACH ROW
       BEGIN
           IF NEW.attendance_status IN (\'Accept\', \'Reject\', \'Pending\') THEN
               UPDATE guest_lists
               SET
                   ceremony = CASE WHEN NEW.event = \'ceremony\' THEN NEW.attendance_status ELSE ceremony END,
                   evening_reception = CASE WHEN NEW.event = \'evening_reception\' THEN NEW.attendance_status ELSE evening_reception END,
                   wedding_breakfast = CASE WHEN NEW.event = \'wedding_breakfast\' THEN NEW.attendance_status ELSE wedding_breakfast END,
                   other = CASE WHEN NEW.event = \'other\' THEN NEW.attendance_status ELSE other END,
                   is_drink = NEW.c_is_drink,
                   select_meal = NEW.meal
               WHERE id = NEW.guest_id;
           END IF;
       END;
   ');

       // Trigger for updating guest_confirms
       DB::unprepared('
           CREATE TRIGGER after_update_guest_confirms
           AFTER UPDATE ON guest_confirms
           FOR EACH ROW
           BEGIN
               IF NEW.attendance_status IN (\'Accept\', \'Reject\', \'Pending\') THEN
                   UPDATE all_guests
                   SET
                       ceremony = CASE WHEN NEW.event = \'ceremony\' THEN NEW.attendance_status ELSE ceremony END,
                       evening_reception = CASE WHEN NEW.event = \'evening_reception\' THEN NEW.attendance_status ELSE evening_reception END,
                       wedding_breakfast = CASE WHEN NEW.event = \'wedding_breakfast\' THEN NEW.attendance_status ELSE wedding_breakfast END,
                       other = CASE WHEN NEW.event = \'other\' THEN NEW.attendance_status ELSE other END,
                       is_drink = NEW.c_is_drink,
                       select_meal = NEW.meal
                   WHERE id = NEW.guest_id;
               END IF;
           END;
       ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guest_confirms', function (Blueprint $table) {
            DB::unprepared('DROP TRIGGER IF EXISTS after_insert_guest_confirms');
            DB::unprepared('DROP TRIGGER IF EXISTS after_update_guest_confirms');
        });
    }


};
