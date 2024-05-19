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
            $table->foreignId('session_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('ticket_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('row')->default(1);
            $table->integer('place')->default(1);
            // $table->string('type')->default('normal');
            $table->enum('type', ['vip', 'normal', 'not allowed']);
            // $table->boolean('is_active')->default(true);
            // $table->boolean('is_vip')->default(false);
            // $table->boolean('is_free')->default(true);
            $table->boolean('is_free')->nullable()->default(true);
            $table->boolean('is_selected')->nullable()->default(false);

            // $table->decimal('price', 8, 2)->nullable();

            $table->float('price', 8, 2)->nullable();
            
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
