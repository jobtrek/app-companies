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
        Schema::create('historique_entreprises', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('apprentis_id')->constrained();
            $table->foreignId('entreprise_id')->constrained();
            $table->date('date_de_départ');
            $table->date('date_de_retour');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_entreprises');
    }
};
