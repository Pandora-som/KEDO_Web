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
            $table->dropForeign('outgoing_letter_destination_fk');
            $table->dropIndex('outgoing_letter_destination_idx');
            $table->dropColumn('destination_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('outgoing_letters', function (Blueprint $table) {
            $table->unsignedBigInteger('destination_id');
            $table->index('destination_id', 'outgoing_letter_destination_idx');
            $table->foreign('destination_id', 'outgoing_letter_destination_fk')->on('destinations')->references('id');
        });
    }
};
