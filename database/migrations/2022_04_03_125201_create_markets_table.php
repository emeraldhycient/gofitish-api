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
        Schema::create('markets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id');
            $table->string('product_name');
            $table->string('product_description');
            $table->string('product_image');
            $table->string('product_price');
            $table->string('product_quantity');
            $table->string('product_category');
            $table->string('product_seller_id');
            $table->string('shop_name');
            $table->integer('ratings')->default(0);
            $table->string('product_status')->default("available");
            $table->integer('product_views')->default(0);
            $table->string('payment_method')->default("cryptocurrency");
            $table->string('product_condition')->default("new");
            $table->string('product_delivery')->default("nationwide");
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
        Schema::dropIfExists('markets');
    }
};