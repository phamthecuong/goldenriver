<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Unknown'])->nullable();
            $table->string('phone_number')->nullable();
            $table->primary('user_id');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->integer('is_active')->default(0)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profile');
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
