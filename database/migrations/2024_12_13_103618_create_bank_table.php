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
        // Create countries table
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create states table
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('country_id');
            $table->timestamps();
        });

        // Create cities table
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('state_id');
            $table->timestamps();
        });

        // Modify the bank table to add country, state, and city foreign keys
        Schema::create('bank', function (Blueprint $table) {
            $table->id();
            $table->string('holdername')->nullable();
            $table->string('accountnumber')->nullable();
            $table->string('ifsccode')->nullable();
            $table->string('image')->nullable(); 
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        
        Schema::dropIfExists('bank');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('states');
        Schema::dropIfExists('countries');
    }
};
