<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversion_histories', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('from_currency_id')->constrained('currencies');
            // $table->foreignId('to_currency_id')->constrained('currencies');
            $table->bigInteger('from_currency_id')->nullable();
            $table->bigInteger('to_currency_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->decimal('converted_amount', 10, 2);
            $table->date('conversion_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversion_histories');
    }
};
