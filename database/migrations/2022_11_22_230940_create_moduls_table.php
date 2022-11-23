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
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('faculty');
            $table->string('level');
//            $table->foreignId('superviser_id')->;
//            $table->foreignId('lecturer_ids')->;
//            $table->integer('semester_count');
//            $table->foreignId('events_id')->;
//            $table->foreignId('workload_id')->;
//            $table->foreignId('credits_id')->;
//            $table->foreignId('examination_work_ids')->;
//            $table->foreignId('pre_examination_work_id')->;
//            $table->foreignId('content_ids')->;
//            $table->foreignId('skill_ids')->;
//            $table->foreignId('optional_skill_ids')->;
//            $table->foreignId('requirement_ids')->;
//            $table->foreignId('option_requirement_ids')->;
//            $table->string('modulux_url');
//            $table->string('opal_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moduls');
    }
};
