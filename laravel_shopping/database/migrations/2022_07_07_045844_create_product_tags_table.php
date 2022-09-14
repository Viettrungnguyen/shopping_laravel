<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tags', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            // $table->foreign('product_id')->references('id')->on('products');
            // $table->foreign('tag_id')->references('id')->on('tags');
            $table->timestamps();
        });
        Schema::table('product_tags', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_tags');
    }
}
