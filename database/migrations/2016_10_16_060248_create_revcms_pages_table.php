<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevcmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revcms_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('controller');
            $table->string('action');
            $table->string('slug')
                    ->unique();
            $table->string('template')
                    ->default('default');
            $table->boolean('hidden')
                    ->default(false);
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
        Schema::dropIfExists('revcms_pages');
    }
}
