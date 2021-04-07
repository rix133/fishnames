<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourceSpeciePivotTable extends Migration
{
    public function up()
    {
        Schema::create('source_specie', function (Blueprint $table) {
            $table->foreignId('source_id')->references('id')->on('sources')->cascadeOnDelete();
            $table->foreignId('specie_id')->references('id')->on('species')->cascadeOnDelete();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('source_specie');
    }
}