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
        Schema::create('addmore', function (Blueprint $table) {
            $table->id();
            $table->integer('bank_id')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('location')->nullable();
            $table->enum('nominee', ['nominee1', 'nominee2', 'nominee3'])->default('nominee1');
            $table->string('document')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addmore');
    }
};
