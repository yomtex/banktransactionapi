<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->decimal('fees', 10, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('reference');
            $table->string('sender');
            $table->string('receiver');
            $table->string('transaction_type'); //debit or credit 
            $table->text('details')->nullable();
            $table->string('gateway_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('channel')->nullable();
            $table->string('currency')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('transaction_id'); // Make it required by removing ->nullable()

            // Add other fields from the payment processor's response
            $table->string('domain')->nullable();
            $table->string('receipt_number')->nullable();
            $table->text('message')->nullable();
            $table->text('metadata')->nullable();
            $table->text('log')->nullable();
            $table->json('authorization')->nullable();
            $table->json('customer')->nullable();
            $table->json('plan')->nullable();
            $table->json('split')->nullable();
            $table->string('order_id')->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->json('plan_object')->nullable();
            $table->json('subaccount')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_histories');
    }
};

