<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->text('link')->nullable();
            $table->uuid('company_id')->nullable();
            $table->uuid('contact_id')->nullable();
            $table->timestamps();
        });
    }
}
