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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('authorId')->nullable(false)->default(0);
            $table->foreignId('ownerId')->nullable(false)->default(0);
            $table->string('task', 255)->nullable(false)->default('');
            $table->enum('priority', [1, 2, 3, 4])->default(3);
            $table->enum('status', [1, 2, 3])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
