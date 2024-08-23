<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // автоинкрементный ID
            $table->string('title')->unique(); // Название продукта
            $table->text('description')->nullable(); // Описание продукта
            $table->decimal('price', 10, 2); // Цена продукта
            $table->string('category')->nullable(); // Категория продукта
            $table->timestamps(); // Время создания и редактирования
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
