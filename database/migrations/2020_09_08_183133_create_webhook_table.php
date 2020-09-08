<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebhookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhook', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->longText('payload')->nullable();
            $table->timestamps();
        });

        //DEV
        \Illuminate\Support\Facades\DB::table('webhook')->insert(
            array(
                'id' => file_get_contents('/proc/sys/kernel/random/uuid'),
                'created_at'=>\Illuminate\Support\Facades\DB::raw('NOW()'),
                'updated_at'=>\Illuminate\Support\Facades\DB::raw('NOW()'),
                'payload'=>'{"id":"313","userId":"32456","email":"32456000@imusics.com","name":"Detentos do Rap","birthday":"1996-06-16T00:00:00-04:00","stamp":"false","instancia":"0","status":"1","mensagem":"USUÁRIO AUTENTICADO","sucesso":"true","timeImport":"2020-09-04T11:56:42-04:00","timeExec":"2020-09-04T12:57:13-04:00"}'
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webhook');
    }
}
