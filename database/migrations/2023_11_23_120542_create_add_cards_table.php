<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // In the create_add_cards_table migration file
    public function up()
    {
        Schema::create('add_cards', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); 
            $table->string('cardnumber');
            $table->string('expmth');
            $table->string('expyear');
            $table->timestamps();
            $table->foreign('user_id')->references('username')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('add_cards');
    }

};
