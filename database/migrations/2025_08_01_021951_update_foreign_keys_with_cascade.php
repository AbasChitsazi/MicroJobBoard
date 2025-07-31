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
    Schema::table('employers', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
    });

    Schema::table('jobs', function (Blueprint $table) {
        $table->dropForeign(['employer_id']);
        $table->foreign('employer_id')
              ->references('id')->on('employers')
              ->onDelete('cascade');
    });

    Schema::table('job_applications', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

        $table->dropForeign(['job_id']);
        $table->foreign('job_id')
              ->references('id')->on('jobs')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
