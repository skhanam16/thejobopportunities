<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Increase the length of the 'title' column to 500 characters
            $table->string('title', 500)->change();
            // Increase the length of other columns, for example, 'description', 'company_name'
            $table->text('description')->change();  // Consider using TEXT for large descriptions
            $table->string('company_name', 500)->change(); // Increase length for 'company_name'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Rollback the column length changes if needed
            $table->string('title', 255)->change();
            $table->string('description', 255)->change();
            $table->string('company_name', 255)->change();
        });
    }
};
