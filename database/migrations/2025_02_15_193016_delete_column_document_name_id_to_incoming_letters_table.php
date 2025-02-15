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
            $table->dropForeign('incoming_letter_document_name_fk');
            $table->dropColumn('document_name_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incoming_letters', function (Blueprint $table) {
            $table->unsignedBigInteger('document_name_id');
            $table->index('document_name_id', 'incoming_letter_document_name_idx');
            $table->foreign('document_name_id', 'incoming_letter_document_name_fk')->on('document_names')->references('id');
        });
    }
};
