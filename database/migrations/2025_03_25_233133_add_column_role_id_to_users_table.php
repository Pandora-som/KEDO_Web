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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->default('1');
            $table->index('role_id', 'users_role_idx');
            $table->foreign('role_id', 'users_role_fk')->on('roles')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_fk');
            $table->dropIndex('users_role_idx');
            $table->dropColumn('role_id');
        });
    }
};
