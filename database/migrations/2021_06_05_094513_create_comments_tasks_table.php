<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_id');
            $table->unsignedBigInteger('author_id');
            $table->string('content');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('author_id')->references('id')->on('users')
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
        Schema::dropIfExists('comments_tasks');
    }
}
