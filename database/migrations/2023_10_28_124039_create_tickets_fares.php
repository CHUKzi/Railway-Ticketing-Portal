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
        Schema::create('tickets_fares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_station_id');
            $table->unsignedBigInteger('to_station_id');
            $table->decimal('class_1_price', 10, 2);
            $table->decimal('class_2_price', 10, 2);
            $table->decimal('class_3_price', 10, 2);
            $table->foreign('from_station_id')->references('id')->on('stations');
            $table->foreign('to_station_id')->references('id')->on('stations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_fares');
    }
};
