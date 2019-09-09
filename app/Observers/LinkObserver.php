<?php

namespace App\Observers;

use App\Link;

class LinkObserver
{
    /**
     * Handle the link "created" event.
     *
     * @param  \App\Link  $link
     * @return void
     */
    public function created(Link $link)
    {
        $link->update([
            'short_link' => $link->getShortLink()
        ]);
    }
}
