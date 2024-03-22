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
        Schema::create('ship_districts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained('ship_divisions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('district_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_districts');
    }
};
