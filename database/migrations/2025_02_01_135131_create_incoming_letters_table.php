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
        Schema::create('incoming_letters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('registration_date');

            $table->unsignedBigInteger('document_from_id');
            $table->index('document_from_id', 'incoming_letter_document_from_idx');
            $table->foreign('document_from_id', 'incoming_letter_document_from_fk')->on('document_froms')->references('id');

            $table->unsignedBigInteger('document_name_id');
            $table->index('document_name_id', 'incoming_letter_document_name_idx');
            $table->foreign('document_name_id', 'incoming_letter_document_name_fk')->on('document_names')->references('id');

            $table->unsignedBigInteger('document_number');
            $table->date('document_date');
            $table->text('document_subject');
            $table->text('resolution');

            $table->unsignedBigInteger('performer_id');
            $table->index('performer_id', 'incoming_letter_performer_idx');
            $table->foreign('performer_id', 'incoming_letter_performer_fk')->on('performers')->references('id');

            $table->date('deadline');

            $table->unsignedBigInteger('status_id');
            $table->index('status_id', 'incoming_letter_status_idx');
            $table->foreign('status_id', 'incoming_letter_status_fk')->on('statuses')->references('id');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_letters');
    }
};
