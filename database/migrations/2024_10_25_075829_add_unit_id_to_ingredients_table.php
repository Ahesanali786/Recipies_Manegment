<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, add the unit_id column to the ingredients table
        Schema::table('ingredients', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable();
        });

        // Update the ingredients table to set unit_id to null where it doesn't exist in units
        DB::table('ingredients')
            ->whereNotIn('unit_id', function ($query) {
                $query->select('id')->from('units');
            })
            ->update(['unit_id' => null]);

        // Now add the foreign key constraint on the ingredients table
        Schema::table('ingredients', function (Blueprint $table) {
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });
    }
};
