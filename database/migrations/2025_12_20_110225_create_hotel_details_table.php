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
        Schema::create('hotel_details', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('count')->nullable();
            $table->unsignedBigInteger('item_type_id');
            $table->foreign('item_type_id')
                ->references('id')->on('item_types')
                  ->onDelete('cascade'); // هذا سيحذف كل التفاصيل تلقائيًا عند حذف النوع
;
              $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')
                ->references('id')->on('hotels')
                  ->onDelete('cascade'); // هذا سيحذف كل التفاصيل تلقائيًا عند حذف النوع
;
            $table->string('place')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_details');
    }
};
