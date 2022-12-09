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
            $table->foreignId('user_first_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_second_id')->constrained('users')->cascadeOnDelete();
            $table->integer('friendship_state');
            $table->primary(['user_first_id', 'user_second_id']);
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
