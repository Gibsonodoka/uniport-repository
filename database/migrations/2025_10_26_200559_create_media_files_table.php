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
    Schema::create('media_files', function (Blueprint $table) {
        $table->id();
        $table->foreignId('item_id')->constrained()->cascadeOnDelete();
        $table->string('disk')->default('public'); // use storage:link
        $table->string('path');                    // e.g., items/2024/uuid.pdf
        $table->string('mime_type')->nullable();
        $table->unsignedBigInteger('size_bytes')->nullable();
        $table->enum('kind', ['pdf','audio','video','image','other'])->default('pdf');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};
