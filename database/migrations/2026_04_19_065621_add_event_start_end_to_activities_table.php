<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dateTime('event_start')->nullable()->after('location');
            $table->dateTime('event_end')->nullable()->after('event_start');
        });

        // Migrate existing event_date data → event_start (set time to 08:00, event_end same day 17:00)
        DB::statement("
            UPDATE activities
            SET
                event_start = CONCAT(event_date, ' 08:00:00'),
                event_end   = CONCAT(event_date, ' 17:00:00')
            WHERE event_date IS NOT NULL
        ");

        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('event_date');
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->date('event_date')->nullable()->after('location');
        });

        DB::statement('
            UPDATE activities
            SET event_date = DATE(event_start)
            WHERE event_start IS NOT NULL
        ');

        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['event_start', 'event_end']);
        });
    }
};
