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
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                // người đại diện
                $table->string('representative', 255)->unique();
                // tên đầy đủ của công ty
                $table->string('company_name')->unique();
                // tên thường gọi của công ty
                $table->string('short_name');
                $table->string('phone_number');
                $table->string('slug');
                $table->string('content');
                $table->foreignId('rating_id')->constrained('ratings', 'id')->cascadeOnDelete();
                $table->string('link', 255)->unique();
                $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
                $table->foreignId('address_id')->constrained('addresses', 'id')->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
