<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('backup_schedules', function (Blueprint $table) {
        $table->id();
        $table->enum('frequency', ['daily', 'weekly', 'monthly']);
        $table->string('backup_time');
        $table->string('backup_day')->nullable();
        $table->integer('backup_day_of_month')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_schedules');
    }
};