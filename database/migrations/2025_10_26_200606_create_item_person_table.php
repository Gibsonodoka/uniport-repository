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
    Schema::create('item_person', function (Blueprint $table) {
        $table->id();
        $table->foreignId('item_id')->constrained()->cascadeOnDelete();
        $table->foreignId('person_id')->constrained()->cascadeOnDelete();
        $table->enum('role', ['author','supervisor','interviewer','interviewee']);
        $table->timestamps();
        $table->unique(['item_id','person_id','role']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_person');
    }
};
