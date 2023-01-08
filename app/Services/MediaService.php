<?php

namespace App\Services;

use App\Models\Card;
use App\Models\User;

class MediaService {
    

    /**
     * addCardMedia
     *
     * @param Card $card
     * @param mixed $images
     */
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

    /**
     * addUserMedia
     *
     * @param User $user
     * @param mixed $image
     */
    public static function addUserMedia(User $user, $image)
    {
        $user->addMedia($image->path())
             ->usingFileName($user->id . '.jpg')
             ->toMediaCollection();
    }

}
