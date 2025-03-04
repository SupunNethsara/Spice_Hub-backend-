<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // $table->string('product_code')->primary()->nullable();
            $table->id();
            $table->string('product_name');
            $table->string('product_sname');
            $table->decimal('Product_price', 10, 2); // Price with 2 decimal places
            $table->string('category'); // Category column added
            $table->decimal('weight', 8, 2); // Weight in grams or other units
            $table->string('unit_of_measurement'); // Unit for weight (e.g., grams, kg)
            $table->integer('stock'); // Stock quantity
             $table->date('expiry_date'); // Expiry date
            $table->text('Product_description'); // Description of the product
            $table->string('Product_image')->nullable(); // Image URL path (nullable)
            $table->timestamps(); // Created at and Updated at columns
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
