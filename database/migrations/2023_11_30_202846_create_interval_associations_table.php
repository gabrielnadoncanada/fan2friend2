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
        Schema::create('interval_associations', function (Blueprint $table) {
            $table->unsignedBigInteger('interval_id');
            $table->unsignedBigInteger('associable_id');
            $table->string('associable_type');
            $table->foreign('interval_id')->references('id')->on('intervals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interval_associations');
    }
};
