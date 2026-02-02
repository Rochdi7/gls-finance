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
            $table->foreignId('level_id')->constrained('levels')->restrictOnDelete();

            // Si tu as déjà teachers => remplace 'professors' par 'teachers'
            $table->foreignId('professor_id')->nullable()->constrained('professors')->nullOnDelete();

            $table->unsignedInteger('students_start_count')->default(0);
            $table->unsignedInteger('students_end_count')->default(0);

            $table->unsignedInteger('price_per_student')->default(0);

            $table->unsignedTinyInteger('month'); // 1..12
            $table->unsignedSmallInteger('year'); // 2023.. etc

            $table->string('status', 20)->default('active'); // active / finished

            $table->timestamps();

            // Unicité “logique” pour éviter doublons (même center+level+prof+mois+année)
            $table->unique(['center_id', 'level_id', 'professor_id', 'month', 'year'], 'groups_unique_per_month');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
