<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255)->unique();
            $table->string('slug', 255)->unique();
            $table->string('short_desc', 255);
            $table->string('long_desc', 1000);
            $table->string('button_text', 40);
            $table->string('button_path', 255);
            $table->string('image_path', 255);
            $table->integer('sort_order');
            $table->boolean('enabled')->default(1);
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
        Schema::dropIfExists('categories');
    }
}
