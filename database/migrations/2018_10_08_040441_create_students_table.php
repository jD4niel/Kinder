<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('second_last_name')->nullable();
            $table->string('degree');
            $table->string('group');
            $table->string('image')->nullable();
            $table->string('qr_code')->nullable();
            $table->unsignedInteger('expedient_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('expedient_id')
                ->references('id')
                ->on('expedients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('students');
    }
}
