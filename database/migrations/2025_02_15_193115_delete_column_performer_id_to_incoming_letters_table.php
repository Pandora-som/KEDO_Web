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
            $table->dropForeign('incoming_letter_performer_fk');
            $table->dropIndex('incoming_letter_performer_idx');
            $table->dropColumn('performer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incoming_letters', function (Blueprint $table) {
            $table->unsignedBigInteger('performer_id');
            $table->index('performer_id', 'incoming_letter_performer_idx');
            $table->foreign('performer_id', 'incoming_letter_performer_fk')->on('performers')->references('id');
        });
    }
};
