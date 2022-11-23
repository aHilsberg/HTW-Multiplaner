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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('faculty');
            $table->string('level');
//            $table->foreignId('supervisor_id')->;
//            $table->integer('semester_count');
//            $table->integer('credits');
//            $table->foreignId('requirement_ids')->;
//            $table->foreignId('allowed_tool_ids')->;
//            $table->string('modulux_url');
//            $table->string('opal_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
};
