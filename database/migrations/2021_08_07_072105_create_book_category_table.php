<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_category', function (Blueprint $table) {
            $table->foreignId('book_id')->index()->references('id')->on('books')->onDelete('cascade');
            $table->foreignId('category_id')->index()->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_category', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('book_category');
    }
}
