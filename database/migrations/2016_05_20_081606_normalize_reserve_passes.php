<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NormalizeReservePasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblreserves', function ($table) {
            $table->tinyInteger('description')->after('ReserveName');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('passes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 45);
            $table->string('description', 255);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->softDeletes();
        });

        Schema::create('pass_durations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 45);
            $table->string('description', 255);
            $table->integer('duration')->unsigned();
            $table->string('duration_metric', 20);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->softDeletes();
        });

        Schema::create('reserve_passes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('reserve_id')->unsigned();
            $table->integer('pass_id')->unsigned();
            $table->integer('pass_duration_id')->unsigned();
            $table->decimal('price', 5, 2);
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reserve_passes');
        Schema::drop('pass_durations');
        Schema::drop('passes');
        Schema::table('tblreserves', function (Blueprint $table) {
            $table->dropColumn(['description', 'created_at', 'updated_at', 'deleted_at']);
        });
    }
}
