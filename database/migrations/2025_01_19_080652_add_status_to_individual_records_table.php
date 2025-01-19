<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToIndividualRecordsTable extends Migration
{
    public function up()
    {
        Schema::table('individual_records', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('management');
        });
    }

    public function down()
    {
        Schema::table('individual_records', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

