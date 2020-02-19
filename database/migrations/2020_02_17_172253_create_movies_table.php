<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            // custom properties
            $table->text('title');
            $table->date('release_date');
            $table->text('description');
            $table->enum('genre_type', ['Horror', 'Comedy', 'Sci-fi', 'Romance',
            'Action', 'Drama', 'Documentary', 'Crime', 'Fantasy']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
