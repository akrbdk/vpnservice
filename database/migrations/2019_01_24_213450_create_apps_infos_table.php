<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('header')->default('download');
            $table->string('content')->nullable();
            $table->string('client')->nullable();
            $table->string('version')->default('1.0.0');
            $table->string('link_install')->nullable();
            $table->string('link_update')->nullable();
            $table->string('button_text')->default('download');
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
        Schema::dropIfExists('apps_infos');
    }
}
