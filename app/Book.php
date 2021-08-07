<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 * @package App
 * @mixin Builder
 */

class Book extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
