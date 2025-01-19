<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('individual_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->text('chief_complaints')->nullable();
            $table->text('vital_signs');
            $table->text('diagnosis')->nullable();
            $table->text('management')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('individual_records');
    }
}