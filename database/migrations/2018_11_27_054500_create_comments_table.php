<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('c_content');
            $table->string('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onupdate('cascade')->ondelete('cascade');
            $table->string('user_id')->unsigned()->references('id')->on('users')->onupdate('restrict')->ondelete('restrict');
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
        Schema::dropIfExists('comments');
    }
}
