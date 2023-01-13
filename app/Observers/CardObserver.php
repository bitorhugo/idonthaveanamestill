<?php

namespace App\Observers;

use App\Models\Card;
use Illuminate\Support\Facades\Cache;

class CardObserver
{
    /**
     * Handle the Card "created" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function created(Card $card)
    {
        $this->clearCache();
    }

    /**
     * Handle the Card "updated" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function updated(Card $card)
    {
        $this->clearCache();
    }

    /**
     * Handle the Card "deleted" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function deleted(Card $card)
    {
        $this->clearCache();
    }

    /**
     * Handle the Card "restored" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function restored(Card $card)
    {
        $this->clearCache();
    }

    /**
     * Handle the Card "force deleted" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function forceDeleted(Card $card)
    {
        $this->clearCache();
    }

    /**
     * clearCache
     * Clears cache for card pagination
     */
    private function clearCache()
    {
        $pages = 100;
        collect(range(1, $pages))->each(function ($i) {
            $key = 'cards-page-' . $i;
            if (Cache::has($key)) {
                Cache::forget($key);
            }
        });
    }    

}
