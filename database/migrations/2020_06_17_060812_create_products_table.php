<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('title');
            $table->string('description');
            $table->integer('price');
            $table->string('city');
            $table->string('state');
            $table->integer('zip_code');
            $table->string('status');
            $table->integer('category_id');
            $table->string('hands');
            $table->string('color');
            $table->string('breed');
            $table->string('gender');
            $table->integer('age');
            $table->string('horses_name');
            $table->integer('view_count');
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
}
