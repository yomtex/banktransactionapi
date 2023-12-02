<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add your new columns here
            $table->string('username')->unique();
            $table->decimal('wallet_balance', 10, 2)->default(0.00);
            $table->string('btc_address')->nullable();
            $table->boolean('withdraw_status');
            $table->string('country');
            $table->char('country_code', 3);


            // Add more columns as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the changes if needed
            $table->dropColumn('username');
            $table->dropColumn('wallet_balance');
            $table->dropColumn('btc_address');
            $table->dropColumn('withdraw_status');
            $table->dropColumn('country');
            $table->dropColumn('country_code');
            // Drop more columns as needed
        });
    }
}
