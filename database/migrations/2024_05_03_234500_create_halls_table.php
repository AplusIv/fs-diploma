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
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('rows')->default(10);
            $table->integer('places')->default(8);
            // $table->decimal('normal_price', 8, 2)->nullable();
            // $table->decimal('vip_price', 8, 2)->nullable();
            // $table->integer('normal_price')->nullable();
            // $table->integer('vip_price')->nullable();
            $table->float('normal_price', 8, 2)->nullable();
            $table->float('vip_price', 8, 2)->nullable();
            $table->json('configuration')->nullable();
            $table->timestamps();
            // name, rows, places,
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
