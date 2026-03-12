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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_number');
            $table->string('address');
            $table->string('selfie_image')->nullable();
            $table->foreignId('fruit_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->timestamp('pickup_time');
            $table->string('status')->default('pending'); // pending, approved, completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
