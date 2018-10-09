<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registries', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('QR_code')->nullable();
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('tutor_id');
            $table->unsignedInteger('vigilant_id');
            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tutor_id')
                ->references('id')->on('tutors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('vigilant_id')
                ->references('id')->on('vigilants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registries');
    }
}
