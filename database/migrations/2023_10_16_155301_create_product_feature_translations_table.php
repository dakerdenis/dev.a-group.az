<?php

use App\Models\ProductFeature;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_feature_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProductFeature::class)->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['product_feature_id', 'locale'], 'product_feature_id_locale_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_feature_translations');
    }
};
