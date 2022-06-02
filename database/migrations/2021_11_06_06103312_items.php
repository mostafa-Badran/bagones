<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('name_locale', 150);
            $table->bigInteger('store_id', false, true);
            $table->bigInteger('sub_category_id', false, true);
            // $table->bigInteger('attribute_id', false, true); //inseted create attribue_item table (many to many relationship)
            
            $table->text('description')->nullable();
            $table->text('description_locale')->nullable();
            $table->text('main_screen_image')->nullable();
            $table->decimal('price', 8, 2, true)->nullable();
            $table->decimal('new_price', 8, 2, true)->nullable();
            // $table->decimal('hot_price', 8, 2, true)->nullable();
            // $table->boolean("onSale")->default(false)->nullable();
            $table->boolean("in_stock")->default(false)->nullable();
            // $table->decimal('sales_price', 8, 2, true)->nullable();
            $table->foreign("store_id")->references("id")->on("stores");
            $table->foreign("sub_category_id")->references("id")->on("categories");
            // $table->foreign("attribute_id")->references("id")->on("attributes");
            $table->timestamps();
            $table->softDeletes();
            // $table->unique(['category_id', 'store_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
