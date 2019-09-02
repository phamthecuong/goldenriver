<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('group_id');
            $table->timestamps();
            $table->primary('name');
        });

        Schema::create('permission_group', function(Blueprint $table) {
            $table->increments('group_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('role', function(Blueprint $table) {
            $table->increments('role_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('role_permission', function (Blueprint $table) {
            $table->integer('role_id');
            $table->string('permission', 255);
            $table->timestamps();
            $table->primary(['role_id', 'permission']);
        });

        Schema::create('user_role', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('role_id');
            $table->timestamps();
            $table->primary(['user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission');
        Schema::dropIfExists('permission_group');
        Schema::dropIfExists('role');
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('user_role');
    }
}
