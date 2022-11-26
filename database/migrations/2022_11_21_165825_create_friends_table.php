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
        Schema::create('friends', function (Blueprint $table) {
            $table->foreignId('user_first_id')->constrained()->cascadeOnDelete()->references('id')->on('users');
            $table->foreignId('user_second_id')->constrained()->cascadeOnDelete()->references('id')->on('users');
            $table->integer('friendship_state');
            $table->primary('user_first_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_user');
    }
};
