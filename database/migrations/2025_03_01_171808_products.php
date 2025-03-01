<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->decimal('Product_price', 10, 2);
            $table->string('Product_image')->nullable();
            $table->text('Product_description');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
