<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_id');//mỗi sản phẩm sẽ có mã danh mục, thương hiệu
            $table->integer('brand_id');
            $table->text('product_name');
            $table->text('product_decs');// mô tả sản phẩm
            $table->text('product_content');//nội dung sản phẩm
            $table->string('product_price'); //giá
            $table->string('product_image');
            $table->integer('product_status');// kích hoạt hay ko
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
        Schema::dropIfExists('tbl_product');
    }
}
