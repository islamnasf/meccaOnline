<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->decimal('price')->nullable();
            $table->string('count')->nullable();
            $table->string('file')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->string('unit')->nullable();
            $table->string('type')->nullable();
            $table->string('place')->nullable();
            $table->string('price_file')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->foreign('hotel_id')
                ->references('id')
                ->on('hotels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
