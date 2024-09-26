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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ticket')->unique();
            $table->string('method');
            $table->string('name');
            $table->string('contact');
            $table->string('email');
            $table->string('area')->index('area');
            $table->string('address')->nullable();
            $table->string('instructions')->nullable();
            $table->string('via');
            $table->float('total');
            $table->boolean('paid')->default(false)->nullable()->index('paid');
            $table->string('stage')->default('received')->nullable()->index('stage');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
