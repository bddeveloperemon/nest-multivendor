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
        Schema::create('ship_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained('ship_divisions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('ship_districts')->onUpdate('cascade')->onDelete('cascade');
            $table->string('state_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_states');
    }
};
