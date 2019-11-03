<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchandisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_order')->unique();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->dateTime('input');
            $table->unsignedBigInteger('withdrawn_by')->nullable();
            $table->foreign('withdrawn_by')->references('id')->on('users');
            $table->dateTime('output')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
            trackables($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandises');
    }
}
