<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');

            $table->string('model')->nullable();
            $table->char('registration_number', 6)->nullable();
            $table->string('color')->nullable();
            $table->integer('year')->unsigned()->nullable();
            $table->integer('mileage')->unsigned()->nullable();
            $table->decimal('price', 10, 2)->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable()->index();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
