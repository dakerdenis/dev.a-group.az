<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('file_static_page', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\File::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\StaticPage::class)->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_file');
    }
};