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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->text('content');
            $table->enum('type', ['text', 'image', 'file'])->default('text'); // Loại tin nhắn
            $table->string('attachment_path')->nullable(); // Đường dẫn tệp đính kèm
            $table->enum('status', ['sent', 'read'])->default('sent');
            $table->timestamp('seen_at')->nullable(); // Thời gian đã đọc
            $table->boolean('is_deleted')->default(false); // Logic xóa tin nhắn
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
