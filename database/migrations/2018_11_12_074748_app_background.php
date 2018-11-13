<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppBackground extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('app_background', function (Blueprint $table) {

        $table->engine = 'InnoDB';
        $table->charset = 'utf8';
        $table->collation = 'utf8_unicode_ci';

        $table->bigIncrements('id');
        $table->text('b_content')->nullable();
        $table->text('b_label')->nullable();

        $table->timestamps();

      });

      DB::table('app_background')->insert(
        array(
            'b_content' => '#006600',
            'b_label' => 'green'
        )
      );

      DB::table('app_background')->insert(
        array(
            'b_content' => '#336666',
            'b_label' => 'blue'
        )
      );

      DB::table('app_background')->insert(
        array(
            'b_content' => '#993300',
            'b_label' => 'brown'
        )
      );

      DB::table('app_background')->insert(
        array(
            'b_content' => '#9966ff',
            'b_label' => 'purple'
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
      Schema::drop('app_background');
    }
}
