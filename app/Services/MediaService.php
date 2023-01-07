<?php

namespace App\Services;

use App\Models\Card;
use App\Models\User;

class MediaService {
    

    public static function addCardMedia(Card $card, $images)
    {
        if (!$images->isEmpty()) {
            $images->each(function ($image, $key) use ($card) {
                $card->addMedia($image->path())
                    ->usingFileName($key . '.jpg')
                    ->toMediaCollection();
            });
        }
    }

    public static function addUserMedia(User $user, $image)
    {
        $user->addMedia($image->path())
             ->usingFileName($user->id . '.jpg')
             ->toMediaCollection();
    }

}
