<?php

namespace App\Services;


class MediaService {
    
    public static function addMedia($item, $images): void
    {
        if (!$images->isEmpty()) {
            $images->each(function ($image, $key) use ($item) {
                $item->addMedia($image->path())
                     ->usingFileName($key . '.jpg')
                     ->toMediaCollection();
            });
        }
    }

}
