<?php

use App\Enums\VoteStatus;
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
        Schema::create('vote_users', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('appointment_id');
            $table->integer('vote_state')->default(VoteStatus::Approve->value);
            $table->primary(['user_id', 'appointment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_users');
    }
};