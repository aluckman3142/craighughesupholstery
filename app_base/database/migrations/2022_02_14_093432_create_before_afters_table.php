<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeforeAftersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('before_afters', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->unique();
            $table->string('description', 1000);
            $table->string('thumb', 255);
            $table->string('before_src', 255);
            $table->string('after_src', 255);
            $table->boolean('enabled')->default(1);
            $table->integer('sort_order');
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
        Schema::dropIfExists('before_afters');
    }
}
