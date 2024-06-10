<?php

namespace App\Models;

use App\Helpers\Loggable;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;

class FaqEntity extends Model implements TranslatableContract
{
    use Translatable, NodeTrait, Loggable;

    public array $translatedAttributes = ['title', 'description'];

    protected $fillable = ['active'];
}
