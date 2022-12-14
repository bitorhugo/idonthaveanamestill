<?php

namespace App\Services;

use App\Models\Card;

class MediaService {

    private function __construct()
    {
        
    }

    
    public static function addMedia(Card $card, $images): void
    {
        if (!$images->isEmpty()) {
            $images->each(function ($image) use ($card) {
                $card->addMedia($image)
                    ->toMediaCollection();
            });
        }
    }


}
