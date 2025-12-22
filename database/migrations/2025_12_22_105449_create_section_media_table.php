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
        Schema::create('section_media', function (Blueprint $table) {
            $table->id();
             $table->string('file')->nullable();
             $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')
                ->references('id')->on('sections')
                ->onDelete('cascade'); // هذا سيحذف كل التفاصيل تلقائيًا عند حذف النوع

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_media');
    }
};
