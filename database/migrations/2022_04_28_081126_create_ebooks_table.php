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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('authors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('ebook_kh', 100);
            $table->text('ebook_eng', 100);
            $table->double('price');
            $table->integer('count_view')->default(0);
            $table->text('desc_kh', 2500)->nullable();
            $table->text('desc_eng', 2500)->nullable();
            $table->string('images', 900)->nullable();
            $table->integer('count_image');
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
        Schema::dropIfExists('ebooks');
    }
};
