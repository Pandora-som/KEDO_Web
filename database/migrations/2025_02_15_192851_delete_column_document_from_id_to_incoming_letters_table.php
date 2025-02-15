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
            $table->dropForeign('incoming_letter_document_from_fk');
            $table->dropColumn('document_from_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incoming_letters', function (Blueprint $table) {
            $table->unsignedBigInteger('document_from_id');
            $table->index('document_from_id', 'incoming_letter_document_from_idx');
            $table->foreign('document_from_id', 'incoming_letter_document_from_fk')->on('document_froms')->references('id');
        });
    }
};
