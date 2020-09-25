<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id');
            $table->string('name');
            $table->string('token');
            $table->timestamps();

            $table->index(['channel_id']);
        });
    }

    /**cle
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropIndex(['channel_id']);
        });
        Schema::dropIfExists('meetings');
    }
}
