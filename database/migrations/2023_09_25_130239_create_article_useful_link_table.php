<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('article_useful_link', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Article::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\UsefulLink::class)->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_useful_link');
    }
};