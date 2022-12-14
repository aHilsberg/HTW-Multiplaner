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
        Schema::create('text_contents', function (Blueprint $table) {
            $table->id();
            $table->string('module_id', 9);
            $table->foreign('module_id')->references('id')->on('modules')->cascadeOnDelete();
            $table->integer('reference');
            $table->text('primary');
            $table->text('secondary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_contents');
    }
};
