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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('customer_code')->nullable()->unique();  // nullable for moderators
            $table->string('email')->unique();
            $table->string('serial_number')->nullable()->unique();  // nullable for moderators
            $table->string('sv_number')->nullable();  // nullable for moderators
            $table->string('fin_code')->nullable();  // nullable for moderators
            $table->string('dial_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('email_verified_at')->nullable();
            $table->float('delivery_balance')->default(0);
            $table->float('order_balance')->default(0);
            $table->string('monthly_limit')->nullable()->default(0);
            $table->enum('delivery_type', ['branch', 'courier', 'azerpost', 'newpost'])->nullable();
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null');
            $table->string('password');
            $table->enum('status', [0, 1])->default(1);
            $table->enum('type', ['user', 'moderator','worker'])->default('user');  // adding type column
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
