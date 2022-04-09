<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->text('bio');
            $table->integer('status')->default(0);
            $table->string('country')->nullable();
            $table->string('coins')->default(5);
            $table->integer('belongs_to')->default(0);
            $table->integer('sub')->default(0);
            $table->string('image')->default('users.png');
            $table->string('followers')->nullable();
            $table->string('friends')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->integer('online_status')->default(0)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
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
