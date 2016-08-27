<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePassRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reserve_passes', function (Blueprint $table) {
            $table->dropColumn(['pass_duration_id']);
        });

        Schema::rename('passes', 'pass_types');

        Schema::create('passes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('description', 1000);
            $table->integer('pass_type_id')->unsigned();
            $table->integer('pass_duration_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
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
        Schema::drop('passes');
        Schema::rename('pass_types', 'passes');
        Schema::table('reserve_passes', function (Blueprint $table) {
            $table->integer('pass_duration_id')->unsigned()->after('pass_id');
        });
    }
}
