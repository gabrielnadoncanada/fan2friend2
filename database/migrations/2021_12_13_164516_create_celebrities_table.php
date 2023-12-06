<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('celebrities', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name')->virtualAs(
                "CONCAT(first_name, ' ', last_name)"
            );
            $table->foreignId('partner_id')->nullable()->constrained('partners')->nullOnDelete();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->decimal('price', 10)->default('5.00')->nullable();
            $table->integer('before_buffer_time')->nullable();
            $table->integer('after_buffer_time')->nullable();
            $table->integer('spot_step');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        DB::statement(
            'ALTER TABLE celebrities ADD FULLTEXT fulltext_index(first_name,last_name, description)'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('celebrities');
    }
};
