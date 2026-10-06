<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('order_number', 50)->unique();
            $table->string('buyer_name', 100);
            $table->string('buyer_username', 100);
            $table->decimal('fee', 15, 2)->default(0);
            $table->string('status', 30);
            $table->text('note')->nullable();
            $table->dateTime('transaction_date');
            $table->dateTime('deadline')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
