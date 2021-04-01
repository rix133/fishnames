<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estnames', function (Blueprint $table) {
            $table->id();
            $table->string('est_name')->unique();
            $table->string('est_genus')->nullable();
            $table->string('est_family')->nullable();
            $table->foreignId('source_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('specie_id');
            $table->boolean('accepted')->default(0);
            $table->boolean('in_termeki')->default(0);
            //$table->unique(['est_name', 'specie_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estnames');
    }
}
