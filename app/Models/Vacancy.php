<?php

namespace App\Models;

use App\Helpers\Loggable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vacancy extends Model implements TranslatableContract
{
    use Translatable, Loggable;

    public array $translatedAttributes = ['title', 'description', 'requirements', 'conditions', 'contacts'];
    protected $fillable = ['slug', 'date', 'active', 'vacancy_place_title_id'];

    protected $casts = [
        'date' => 'datetime',
        'active' => 'boolean',
    ];

    public function generateLink(Category $category): string
    {
        return route('vacancy', ['category' => $category->slug, 'vacancy' => $this->slug]);
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class)->withPivot('order')->orderBy('order');
    }

    public function vacancyPlaceTitle(): BelongsTo
    {
        return $this->belongsTo(VacancyPlaceTitle::class);
    }
}
