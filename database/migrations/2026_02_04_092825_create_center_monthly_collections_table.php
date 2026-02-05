<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('center_monthly_collections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('center_id')
                ->constrained('centers')
                ->cascadeOnDelete();

            // Période
            $table->unsignedSmallInteger('year');      // ex: 2026
            $table->unsignedTinyInteger('month');      // 1..12

            $table->decimal('cash_amount', 12, 2)->default(0);          // Espèces
            $table->decimal('tpe_amount', 12, 2)->default(0);           // TPE / carte
            $table->decimal('bank_transfer_amount', 12, 2)->default(0); // Virement bancaire
            $table->decimal('cheque_amount', 12, 2)->default(0);        // Chèque

            $table->decimal('total_amount', 12, 2)
                ->storedAs('(cash_amount + tpe_amount + bank_transfer_amount + cheque_amount)');

            $table->text('note')->nullable();

            $table->timestamps();

            $table->unique(['center_id', 'year', 'month']);

            $table->index(['year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('center_monthly_collections');
    }
};
