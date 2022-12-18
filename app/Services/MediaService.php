<?php

namespace App\Services;

use App\Models\Card;

class MediaService {
    
    public static function addMedia(Card $card, $images): void
    {
        if (!$images->isEmpty()) {
            $images->each(function ($image, $key) use ($card) {
                $card->addMedia($image)
                     ->usingFileName($key . '.jpg')
                     ->toMediaCollection();
            });
        }
    }


}
