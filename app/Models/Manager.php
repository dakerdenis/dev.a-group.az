<?php

namespace App\Models;
use App\Helpers\Loggable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Manager extends Model implements TranslatableContract, HasMedia
{
    use Translatable;
    use InteractsWithMedia;
    use Loggable;
    use NodeTrait;

    public array $translatedAttributes = ['title', 'position'];

    protected $fillable = ['id', 'active', 'phone', 'email'];



    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 370, 500)->performOnCollections('preview')->format('webp');

        $this->addMediaConversion('webp')->performOnCollections('preview')->format('webp');
    }
}
