<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('comment_id')->nullable();
            $table->integer('file_id')->nullable();
            $table->string('title',255);   
            $table->string('subtitle',255);
            $table->string('slug',100);
            $table->boolean('status')->nullable()->default(0);
            $table->text('body',1000);
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
        Schema::dropIfExists('posts');
    }
}
