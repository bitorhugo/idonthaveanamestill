<?php
namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    /**
     * getPath
     *
     * @param Media $media
     *
     * @return string path for media
     */
   public function getPath(Media $media): string
   {
    return $media->model_type . '/' . $media->model_id . '/';
   }

    /**
     * getPathForConversions
     *
     * @param Media $media
     *
     * @return string path for converions
     */
   public function getPathForConversions(Media $media): string
   {
    return $media->model_type . '/' . $media->model_id . '/conversion/';
   }

    /**
     * getPathForResponsiveImages
     *
     * @param Media $media
     *
     * @return string path for responsive images
     */
   public function getPathForResponsiveImages(Media $media): string
   {
    return $media->model_type . '/' . $media->model_id . '/responsive-images/';
   }

   
}
