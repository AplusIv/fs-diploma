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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('hall_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->date('date');            
            $table->time('time');
            $table->boolean('is_sales_active')->default(false); // открыть/закрыть продажу билетов на сеансы
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
