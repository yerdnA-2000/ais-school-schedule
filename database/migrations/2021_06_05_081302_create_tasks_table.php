<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('executor_id');
            $table->string('title');
            $table->text('content');
            $table->dateTime('start');
            $table->dateTime('finish');
            $table->dateTime('deadline');
            $table->tinyInteger('is_important')->default(0)->unsigned();
            $table->tinyInteger('status')->unsigned();
            $table->unsignedInteger('previous_task')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('executor_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.

     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
