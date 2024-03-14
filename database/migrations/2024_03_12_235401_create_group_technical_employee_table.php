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
        Schema::create('group_technical_employee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technical_employee_id')->constrained('technical_employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->primary(['group_id', 'technical_employee_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_technical_employee');
    }
};
