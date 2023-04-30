<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /** ToDo: Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different showrooms

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        // Create table for user_stories
        Schema::create('user_stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // Create table for movies
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->foreignId('user_story_id')->constrained();
            $table->timestamps();
        });

        // Create table for showtimes
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->foreignId('movie_id')->constrained();
            $table->timestamps();
        });

        // Create table for cinemas
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->timestamps();
        });

        // Create table for cinema rooms
        Schema::create('cinema_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('cinema_id')->constrained();
            $table->timestamps();
        });

        // Create table for shows
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cinema_room_id')->constrained();
            $table->foreignId('showtime_id')->constrained();
            $table->timestamps();
        });

        // Create table for pricing
        Schema::create('pricing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('showtime_id')->constrained();
            $table->string('seat_type');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        // Create table for seats
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cinema_room_id')->constrained();
            $table->string('row');
            $table->integer('number');
            $table->string('seat_type');
            $table->boolean('booked')->default(false);
            $table->timestamps();
        });
        
        // throw new \Exception('implement in coding task 4, you can ignore this exception if you are just running the initial migrations.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
