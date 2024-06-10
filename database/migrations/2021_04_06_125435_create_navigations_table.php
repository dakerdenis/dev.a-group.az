<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationsTable extends Migration
{
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('machine_name', 64);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('navigations');
    }
}