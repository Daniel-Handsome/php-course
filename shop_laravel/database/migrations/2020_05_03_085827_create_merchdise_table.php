<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchdiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandise', function (Blueprint $table) {
            $table->increments('id');

            //C:建立  S:可販售
            $table->string('status',1)->default('C');
            $table->string('name',80)->nullable();
            $table->string('name_en',80)->nullable();
            $table->text('introduction')->nullable();
            $table->text('introduction_en')->nullable();
            $table->string('photo')->nullable();
            $table->integer('price')->nullable();
            $table->integer('remain_count')->nullable();
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
        Schema::dropIfExists('merchandise');
    }
}
