<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('add_cards_money', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); 
            $table->string('name');
            $table->string('cardnumber');
            $table->string('expmth');
            $table->string('expyear');
            $table->timestamps();

            $table->foreign('user_id')->references('username')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('add_cards_money');
    }
};
