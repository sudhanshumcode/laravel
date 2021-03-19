<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usermeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usermetas', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')->on('users')
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
        //
    }
}
