<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_no')->nullable()->default(null)->unique();
            $table->boolean('is_employee')->default(0);

            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('username')->unique()->nullable();
            $table->date('birthdate')->nullable()->default(null);
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('slug')->unique()->nullable();

            $table->integer('image_file_id')->nullable()->default(null);

            $table->integer('access_property_id')->nullable();

            $table->timestamp('last_login')->nullable();
            $table->boolean('online')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
