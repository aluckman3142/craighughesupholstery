<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpholsteryClassEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upholstery_class_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('subject', 255);
            $table->string('type', 100);
            $table->string('project_description', 1000);
            $table->string('image', 255);
            $table->string('status', 20);
            $table->integer('days_required');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('width', 50);
            $table->string('height', 50);
            $table->string('depth', 50);
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
        Schema::dropIfExists('upholstery_class_enquiries');
    }
}



