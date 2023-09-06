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
        Schema::create('samsats', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code_samsat', 25);
            $table->integer('car_id')->nullable();
            $table->integer('motor_id')->nullable();
            $table->date('old_samsat')->nullable();
            $table->date('renew_samsat')->nullable();
            $table->date('new_samsat')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('samsats');
    }
};
