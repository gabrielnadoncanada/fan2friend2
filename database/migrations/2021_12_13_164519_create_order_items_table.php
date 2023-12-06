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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('unit_price', 12);
            $table->decimal('total_price', 12);
            $table->foreignId('celebrity_id')->constrained();
            $table->time('start_time');
            $table->integer('duration');
            $table->integer('quantity');
            $table->date('scheduled_date');
            $table->string('wday')->virtualAs(
                "DATE_FORMAT(scheduled_date, '%W')"
            );
            $table->time('end_time')->virtualAs(
                "ADDTIME(start_time, SEC_TO_TIME(duration * quantity * 60))"
            );
            $table->string('status')->default('pending');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
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
        Schema::dropIfExists('order_items');
    }
};
