<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialDataInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('social_id')->nullable()->change();
            $table->string('social_type')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('country_code')->nullable()->change();
            $table->string('last_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('social_id')->nullable(false)->change();
            $table->string('social_type')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('country')->nullable(false)->change();
            $table->string('country_code')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
        });
    }
}
