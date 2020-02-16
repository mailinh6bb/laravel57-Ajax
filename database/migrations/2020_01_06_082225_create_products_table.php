<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table -> string('name');
            $table -> string('slug');
            $table-> integer('qty');
            $table -> string('description');
            $table -> string('content');
            $table -> decimal('price');
            $table -> decimal('promitinal');
            $table -> integer('sale');
            $table -> integer('cate_id');
            $table -> integer('pro_type_id');
            $table -> integer('status') -> default(0);
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
