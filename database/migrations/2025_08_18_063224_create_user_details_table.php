<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_registration_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();

            $table->foreign('user_registration_id')->references('id')->on('user_registration')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
