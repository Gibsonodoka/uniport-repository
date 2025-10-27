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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            // Basic Details
            $table->string('title');
            $table->text('abstract')->nullable();
            $table->year('year')->nullable();

            // Type of Record
            $table->enum('type', [
                'final_year_project',
                'term_paper',
                'seminar_paper',
                'oral_history',
                'faculty_publication',
                'department_record'
            ])->index();

            // Academic Details
            $table->string('course_code')->nullable()->index();   // e.g. HIS 201
            $table->string('supervisor')->nullable();

            // Relationships
            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // Status Workflow
            $table->enum('status', ['pending', 'approved'])
                  ->default('pending')
                  ->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
