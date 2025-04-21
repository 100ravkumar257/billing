<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id')->nullable(); // Make sure this matches the type of `categories.id`
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // Foreign key
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->date('expiry_date');
            $table->boolean('prescription_required')->default(false);
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
        Schema::dropIfExists('medicines');
    }
}
