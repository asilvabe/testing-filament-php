<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->string('name', 90)->index();
            $table->string('brand', 60)->nullable();
            $table->foreignId('document_type_id')->nullable()->constrained('document_types');
            $table->string('document', 30)->nullable();
            $table->string('website_url', 150)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
