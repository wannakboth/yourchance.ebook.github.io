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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ebook_id')->unsigned();
            $table->foreign('ebook_id')->references('id')->on('ebooks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('content_kh', 250);
            $table->text('content_eng', 250);
            $table->integer('count_minute');
            $table->boolean('is_read')->default(0);
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
        Schema::dropIfExists('contents');
    }
};
