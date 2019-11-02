<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('external_id')->nullable();
            $table->foreign('external_id')->references('id')->on('users');
            $table->unsignedBigInteger('internal_id')->nullable();
            $table->foreign('internal_id')->references('id')->on('users');
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
        Schema::dropIfExists('clients');
    }
}
