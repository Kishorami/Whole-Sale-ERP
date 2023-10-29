<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('item_description');
            $table->string('sku')->unique();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->integer('stock')->default(0);
            $table->integer('sold')->default(0);
            $table->double('unit_price');
            $table->double('sell_price_low');
            $table->double('sell_price_high');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
