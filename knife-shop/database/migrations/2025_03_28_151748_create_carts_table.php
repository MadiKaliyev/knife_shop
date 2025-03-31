<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->integer('quantity')->default(1); // Количество товара
        });
    }


    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
