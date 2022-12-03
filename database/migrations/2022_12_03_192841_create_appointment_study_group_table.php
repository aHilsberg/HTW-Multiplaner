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
        Schema::create('appointment_study_group', function (Blueprint $table) {
            $table->string('study_group_id');
            $table->foreign('study_group_id')->references('id')->on('study_groups')->cascadeOnDelete();
            $table->foreignId('appointment_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_study_group');
    }
};
