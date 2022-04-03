<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_photo', function (Blueprint $table) {
            $table->id();
            $table
                ->integer('id_photo')
                ->unsigned()
                ->index()
                ->nullable();
            $table
                ->integer('id_users')
                ->unsigned()
                ->index()
                ->nullable();
            $table->timestamps();
        });

        Schema::table('like_photo', function (Blueprint $table) {
            $table
                ->foreign('id_photo')
                ->references('id')
                ->on('photo')
                ->onDelete('cascade');
            $table
                ->foreign('id_users')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('like_photo');
    }
}
