<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('motor_category', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('motor_id');
                $table->foreign('motor_id')->references('id')->on('motors');
                $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')->references('id')->on('categories');
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
            Schema::dropIfExists('car_category');
        }
};
