<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('monthly_financials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('center_id')->constrained('centers')->cascadeOnDelete();

            $table->unsignedTinyInteger('month'); // 1..12
            $table->unsignedSmallInteger('year');

            $table->unsignedInteger('total_students')->default(0);
            $table->unsignedInteger('total_revenue')->default(0);

            $table->unsignedInteger('owner_share_50')->default(0);
            $table->unsignedInteger('professors_share_35')->default(0);
            $table->unsignedInteger('other_costs_15')->default(0);

            $table->boolean('is_historical')->default(false);
            $table->boolean('locked')->default(false);

            $table->timestamps();

            $table->unique(['center_id', 'month', 'year'], 'monthly_financials_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_financials');
    }
};
