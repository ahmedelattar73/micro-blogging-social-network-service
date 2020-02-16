<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddBirthDateAndAgeColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {

            Schema::table('users', function (Blueprint $table) {
                $table->date('birth_date')->after('image');
                $table->integer('age')->after('birth_date')->comment('User age to floor');
            });

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {

            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('birth_date');
                $table->dropColumn('age');
            });

        });
    }
}
