<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Card extends Model implements HasMedia
{
    use HasFactory, Searchable;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * registerMediaConversions
     * registers media conversions for cards
     * @param Media $media
     *
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this ->addMediaConversion('thumb')
              ->width(225)
              ->height(225);
    }

    /**
     * categories
     * relation card -> categories
     * intermidiate table used
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'card__categories')
                    ->withTimestamps()
                    ->as('categories');
    }

    /**
     * inventory
     * relation card -> inventory
     */
    public function inventory()
    {
        return $this->hasOne(Inventory::class)->withDefault();
    }

}
