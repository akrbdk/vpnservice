<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangesToPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans_table', function (Blueprint $table) {
            $table->string('server_access')->default('basic')->nullable();
            $table->string('speed_limit')->nullable();
            $table->string('months_limit')->nullable();
            $table->string('price')->default(0)->nullable();
            $table->longText('advantages')->nullable();
            $table->longText('more_advantages')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            //
        });
    }
}
