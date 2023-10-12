<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFieldsNullableInBusinessProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_profiles', function (Blueprint $table) {
            $table->string('business_name')->nullable()->change();
            $table->string('business_tagline')->nullable()->change();
            $table->string('business_description')->nullable()->change();
            $table->string('business_image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_profiles', function (Blueprint $table) {
            $table->dropColumn('business_name');
            $table->dropColumn('business_tagline');
            $table->dropColumn('business_description');
            $table->dropColumn('business_image');
        });
    }
}
