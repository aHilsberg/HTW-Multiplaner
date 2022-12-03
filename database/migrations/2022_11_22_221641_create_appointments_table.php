<?php

use App\Enums\RecurrenceState;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->date('origin_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('recurrence')->default(RecurrenceState::None->value);
            $table->string('location')->nullable();
            $table->string('details')->nullable();
            $table->integer('info')->nullable();
            $table->bigInteger('appointable_id')->nullable();
            $table->string('appointable_type')->nullable();
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
        Schema::dropIfExists('appointments');
    }
};
