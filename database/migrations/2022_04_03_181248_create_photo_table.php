<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo', function (Blueprint $table) {
            $table->id();
            $table
                ->integer('id_users')
                ->unsigned()
                ->index()
                ->nullable();
            $table->string('foto')->nullable();
            $table->string('caption')->nullable();
            $table->string('tags')->nullable();
            $table->timestamps();
        });

        Schema::table('photo', function (Blueprint $table) {
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
        Schema::dropIfExists('photo');
    }
}
