<?php

namespace Modules\Content\Observers;

use Modules\Content\Events\ContentCreated;
use Modules\Content\Models\Content;

class ContentObserver
{
    public function created(Content $content)
    {
        event(new ContentCreated($content));
    }

    public function updated(Content $content)
    {
        if ($content->is_published && $content->wasChanged('is_published')) {
            event(new ContentCreated($content));
        }
    }
}
