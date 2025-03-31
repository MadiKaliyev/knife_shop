<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_knives_table.php

    public function up()
    {
        Schema::create('knives', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название ножа
            $table->text('description'); // Описание ножа
            $table->decimal('price', 50, 2); // Цена ножа
            $table->string('image')->nullable(); // Изображение ножа
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knives');
    }
};
