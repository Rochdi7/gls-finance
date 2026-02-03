<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');            // GLS Marrakech
            $table->string('city')->nullable(); // Marrakech
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index(['active', 'city']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('centers');
    }
};
