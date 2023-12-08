<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('number', 32)->unique();
            $table->decimal('total_price', 12)->nullable();
            $table->decimal('subtotal', 12)->nullable();
            $table->decimal('taxes', 12)->nullable();
            $table->decimal('discount', 12)->nullable();
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->string('checkout_token')->nullable();
            $table->date('order_date');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
