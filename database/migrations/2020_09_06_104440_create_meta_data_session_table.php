<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaDataSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_data_session', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->text('meta')->nullable();
            $table->uuid('company_id')->nullable();
            $table->uuid('contact_id')->nullable();
            $table->timestamps();
        });
    }
}
