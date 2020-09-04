<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_request', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('endpoint')->nullable();
            $table->string('method')->nullable();
            $table->longText('request')->nullable();
            $table->longText('response')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
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
        Schema::drop('request');
    }
}
