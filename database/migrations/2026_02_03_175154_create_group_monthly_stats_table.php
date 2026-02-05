<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('group_monthly_stats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('group_id')
                ->constrained('groups')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('month'); // 1..12
            $table->unsignedSmallInteger('year');

            // 📊 Données mensuelles
            $table->unsignedInteger('students_start_count')->default(0);
            $table->unsignedInteger('students_end_count')->default(0);

            $table->unsignedInteger('revenue')->default(0);

            $table->timestamps();

            // Un seul record par groupe / mois / année
            $table->unique(
                ['group_id', 'month', 'year'],
                'group_monthly_unique'
            );

            $table->index(['year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_monthly_stats');
    }
};
