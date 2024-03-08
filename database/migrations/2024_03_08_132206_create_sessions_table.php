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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('assignment_id')->nullable()->constrained('assignments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('instractor_id')->nullable()->constrained('technical_employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('mentor_id')->nullable()->constrained('technical_employees')->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('number_of_attendance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
