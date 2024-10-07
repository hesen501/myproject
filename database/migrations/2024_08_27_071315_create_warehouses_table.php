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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->string('phone');
            $table->string('address');
            $table->string('tc_identity');
            $table->integer('flights_weekly');
            $table->string('default_website');
            $table->float('weight_limit');
            $table->string('currency_id');
            $table->integer('print_label');
            $table->integer('parcelling');
            $table->integer('auto_print');
            $table->integer('packaging');
            $table->string('fake_invoice');
            $table->integer('show_label');
            $table->integer('show_invoice');
            $table->string('neighborhood');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
