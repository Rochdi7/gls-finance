<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();

            $table->foreignId('center_id')->constrained('centers')->cascadeOnDelete();
            $table->foreignId('professor_id')->nullable()->constrained('professors')->nullOnDelete();

            // ✅ Nom du groupe (lisible humainement)
            $table->string('name', 150);

            // Niveau logique
            $table->string('level_code', 10); // A1, A2, B1, B2

            $table->unsignedInteger('students_start_count')->default(0);
            $table->unsignedInteger('students_end_count')->default(0);

            $table->unsignedInteger('price_per_student')->default(0);

            $table->unsignedTinyInteger('month'); // 1..12
            $table->unsignedSmallInteger('year'); // 2023+

            $table->string('status', 20)->default('active');

            $table->timestamps();

            // Unicité logique
            $table->unique(['center_id', 'level_code', 'professor_id', 'month', 'year'], 'groups_unique_per_month');

            // Index
            $table->index(['year', 'month']);
            $table->index(['center_id', 'year', 'month']);
            $table->index(['professor_id', 'year', 'month']);
            $table->index(['level_code', 'year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
