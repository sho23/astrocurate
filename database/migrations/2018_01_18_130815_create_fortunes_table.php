<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFortunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortunes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('site_id')->unsigned();
            $table->integer('astro_id')->unsigned();
            $table->integer('general')->nullable();
            $table->integer('love')->nullable();
            $table->integer('job')->nullable();
            $table->integer('money')->nullable();
            $table->integer('ranking')->nullable();
            $table->date('date');
            $table->string('url_code');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->foreign('site_id')
                    ->references('id')
                    ->on('sites')
                    ->onDelete('cascade');
            $table->foreign('astro_id')
                    ->references('id')
                    ->on('astros')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fortunes');
    }
}
