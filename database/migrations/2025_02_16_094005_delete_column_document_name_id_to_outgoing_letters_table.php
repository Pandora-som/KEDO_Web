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
        Schema::table('outgoing_letters', function (Blueprint $table) {
            $table->dropForeign('ougoing_letter_document_name_fk');
            $table->dropIndex('outgoing_letter_document_name_idx');
            $table->dropColumn('document_name_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('outgoing_letters', function (Blueprint $table) {
            $table->unsignedBigInteger('document_name_id');
            $table->index('document_name_id', 'outgoing_letter_document_name_idx');
            $table->foreign('document_name_id', 'ougoing_letter_document_name_fk')->on('document_names')->references('id');
        });
    }
};
