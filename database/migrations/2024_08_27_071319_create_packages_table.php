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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code');
            $table->string('cwb_number');
            $table->float('weight');
            $table->float('invoice');
            $table->string('currency_id');
            $table->integer('quantity');
            $table->string('description');
            $table->string('invoice_file');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('shelf_id')->nullable();
            $table->string('store');
            $table->integer('is_liquid');
            $table->integer('has_battery');
            $table->integer('print');
            $table->integer('status');
            $table->integer('waiting_declare_date');
            $table->enum('type',['home','abroad']);
            $table->foreignId('parcel_id')->nullable()->constrained()->onDelete('cascade');
            $table->float('delivery_cost');
            $table->float('delivery_cost_azn');
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
            $table->enum('delivery_type',['branch','courier','azerpost','newpost']);
            $table->string('delivery');
            $table->integer('delivery_paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
