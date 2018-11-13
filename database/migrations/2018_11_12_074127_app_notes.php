<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('app_notes', function (Blueprint $table) {

        $table->engine = 'InnoDB';
        $table->charset = 'utf8';
        $table->collation = 'utf8_unicode_ci';

        $table->bigIncrements('id');
        $table->longText('n_text')->nullable();
        $table->bigInteger('n_background');

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
      Schema::drop('app_notes');
    }
}
