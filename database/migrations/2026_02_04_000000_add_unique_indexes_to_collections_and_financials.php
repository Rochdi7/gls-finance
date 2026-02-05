<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add unique index to center_monthly_collections
        // This prevents duplicate entries for the same center, year, and month
        Schema::table('center_monthly_collections', function (Blueprint $table) {
            // Check if index doesn't already exist before adding
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $doctrineTable = $sm->introspectTable('center_monthly_collections');

            if (!$this->hasUniqueIndex($doctrineTable, ['center_id', 'year', 'month'])) {
                $table->unique(['center_id', 'year', 'month'], 'unique_center_year_month');
            }
        });

        // Add unique index to monthly_financials if it exists
        if (Schema::hasTable('monthly_financials')) {
            Schema::table('monthly_financials', function (Blueprint $table) {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $doctrineTable = $sm->introspectTable('monthly_financials');

                if (!$this->hasUniqueIndex($doctrineTable, ['center_id', 'year', 'month'])) {
                    $table->unique(['center_id', 'year', 'month'], 'unique_center_year_month_financials');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('center_monthly_collections', function (Blueprint $table) {
            $table->dropUnique('unique_center_year_month');
        });

        if (Schema::hasTable('monthly_financials')) {
            Schema::table('monthly_financials', function (Blueprint $table) {
                $table->dropUnique('unique_center_year_month_financials');
            });
        }
    }

    /**
     * Check if a unique index exists on the given columns.
     *
     * @param \Doctrine\DBAL\Schema\Table $doctrineTable
     * @param array $columns
     * @return bool
     */
    private function hasUniqueIndex($doctrineTable, array $columns): bool
    {
        foreach ($doctrineTable->getIndexes() as $index) {
            if ($index->isUnique()) {
                $indexColumns = $index->getColumns();
                if (array_values($indexColumns) === $columns) {
                    return true;
                }
            }
        }
        return false;
    }
};
