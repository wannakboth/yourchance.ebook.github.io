<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('content_id')->unsigned();
            $table->foreign('content_id')->references('id')->on('contents')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('header_kh', 250);
            $table->text('header_eng', 250);
            $table->text('sub_header_kh', 25000);
            $table->text('sub_header_eng', 25000);
            $table->string('images', 900);
            $table->integer('orderby');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('lessons');
    }
};
