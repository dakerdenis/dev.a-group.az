<?php

use App\Models\Article;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->nestedSet();
        });

        Article::fixTree();
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropNestedSet();
        });
    }
};
