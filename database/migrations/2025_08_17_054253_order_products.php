<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_sname');
            $table->decimal('Product_price', 10, 2);
            $table->string('category');
            $table->decimal('weight', 8);
            $table->string('unit_of_measurement');
            $table->integer('stock');
            $table->date('expiry_date');
            $table->text('Product_description');
            $table->string('Product_image')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
