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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('condition',['orderable','rented','damaged', 'retired (other reason)'])->default('orderable');
            $table->string('edition_isbn');
            $table->foreignId('library_id')->constrained()->onDelete('cascade');
            
            $table->foreign('edition_isbn')->references('isbn')->on('editions')->constrained()->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
