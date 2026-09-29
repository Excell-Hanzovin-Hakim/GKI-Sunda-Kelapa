<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wartas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->date('edition_date');
            $table->text('summary')->nullable();
            $table->string('pdf_path');
            $table->boolean('is_published')->default(false);

            $table->foreignId('uploaded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wartas');
    }
};