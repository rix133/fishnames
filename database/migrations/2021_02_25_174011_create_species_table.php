<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string("latin_name")->unique();
            $table->boolean("is_genus")->default(0);
            $table->string("latin_family")->nullable();
            $table->string("eng_name")->nullable();
            $table->string("describer")->nullable();
            $table->integer("year_described")->nullable();
            $table->foreignId('source_id')->nullable();
            $table->foreignId('confirmed_estname_id')->nullable();
            $table->foreignId('new_id')->nullable(); // if this is set it is an old latin name
            $table->text('photo_path')->nullable();
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
        Schema::dropIfExists('species');
    }
}
