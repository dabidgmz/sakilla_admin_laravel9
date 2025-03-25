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
        Schema::table('staff', function (Blueprint $table) {
            $table->string('temp_code', 64)->after('password')->nullable();
            $table->string('google_id')->nullable()->after('temp_code');
            $table->unsignedBigInteger('role_id')->after('google_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            if (Schema::hasColumn('staff', 'role_id')) {
                $table->dropForeign(['role_id']);
                $table->dropColumn('role_id');
            }

            if (Schema::hasColumn('staff', 'google_id')) {
                $table->dropColumn('google_id');
            }

            if (Schema::hasColumn('staff', 'temp_code')) {
                $table->dropColumn('temp_code');
            }
        });
    }
};
