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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('row')->default(1);
            $table->integer('place')->default(1);
            $table->enum('type', ['vip', 'standart', 'disabled']);
            $table->boolean('is_selected')->nullable()->default(false); // уточнить необходимость
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
