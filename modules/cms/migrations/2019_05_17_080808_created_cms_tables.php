<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedCmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function(Blueprint $table) {
            $table->increments('category_id')->unsigned();
            $table->string('title', '255');
            $table->string('description', 255)->nullable();
            $table->integer('parent_id')->default(0);
            $table->string('slug', 255)->nullable();
            $table->integer('published_f')->default(0);
            $table->integer('deleted_f')->default(0);
            $table->integer('created_by')->default(0);
            $table->timestamps();
        });

        Schema::create('category_meta', function (Blueprint $table) {
            $table->integer('category_id')->primary();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });

        Schema::create('post', function(Blueprint $table) {
            $table->increments('post_id');
            $table->string('title', 255);
            $table->string('slug', 255)->nullable();
            $table->integer('category_id');
            $table->string('description', 255);
            $table->text('content');
            $table->string('avatar');
            $table->integer('published_f')->default(0);
            $table->integer('is_feature')->default(0);
            $table->integer('deleted_f')->default(0);
            $table->integer('created_by')->default(0);
            $table->timestamps();
        });

        Schema::create('post_meta', function(Blueprint $table) {
            $table->integer('post_id')->primary();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
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
        Schema::dropIfExists('category');
        Schema::dropIfExists('category_meta');
        Schema::dropIfExists('post');
        Schema::dropIfExists('post_meta');
    }
}
