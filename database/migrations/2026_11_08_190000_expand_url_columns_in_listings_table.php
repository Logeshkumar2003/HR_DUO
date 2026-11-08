<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE listings MODIFY application_url TEXT NULL');
        DB::statement('ALTER TABLE listings MODIFY website TEXT NOT NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE listings MODIFY application_url VARCHAR(500) NULL');
        DB::statement('ALTER TABLE listings MODIFY website VARCHAR(255) NOT NULL');
    }
};

