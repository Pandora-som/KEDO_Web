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
        Schema::create('outgoing_letters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->dateTime('registarion_date');

            $table->unsignedBigInteger('destination_id');
            $table->index('destination_id', 'outgoing_letter_destination_idx');
            $table->foreign('destination_id', 'outgoing_letter_destination_fk')->on('destinations')->references('id');

            $table->unsignedBigInteger('document_name_id');
            $table->index('document_name_id', 'outgoing_letter_document_name_idx');
            $table->foreign('document_name_id', 'ougoing_letter_document_name_fk')->on('document_names')->references('id');

            $table->text('document_subject');

            $table->unsignedBigInteger('signer_id');
            $table->index('signer_id', 'outgoing_letter_signer_idx');
            $table->foreign('signer_id', 'outgoing_letter_signer_fk')->on('signers')->references('id');

            $table->unsignedBigInteger('performer_id');
            $table->index('performer_id', 'outgoing_letter_performer_idx');
            $table->foreign('performer_id', 'outgoing_letter_performer_fk')->on('performers')->references('id');

            $table->unsignedBigInteger('incoming_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_letters');
    }
};
