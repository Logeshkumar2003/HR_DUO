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
        Schema::table('contact_inquiries', function (Blueprint $table) {
            $table->string('email_status')->default('pending')->after('message');
            $table->text('email_error')->nullable()->after('email_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_inquiries', function (Blueprint $table) {
            $table->dropColumn(['email_status', 'email_error']);
        });
    }
};

