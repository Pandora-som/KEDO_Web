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
        Schema::table('incoming_letters', function (Blueprint $table) {
            $table->unsignedBigInteger('classificator_id')->nullable();
            $table->index('classificator_id', 'incoming_letter_classificator_idx');
            $table->foreign('classificator_id', 'incoming_letter_classificator_fk')->on('classificators')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incoming_letters', function (Blueprint $table) {
            $table->dropColumn('classificator_id');
        });
    }
};
