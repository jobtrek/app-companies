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
        Schema::create('apprentis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255);
            $table->string('lastname', 255);
            $table->string('photo');
            $table->string('role');
            $table->integer('age');
            $table->date('birthday');
            $table->string('email');
            $table->string('password');
            $table->string('CV');
            $table->string('phone_number');
            $table->foreignId('coach_id')->constrained();
            $table->foreignId('formateur_id')->constrained();
            $table->string('entreprise');
            $table->boolean('admin')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apprentis');
    }
};
