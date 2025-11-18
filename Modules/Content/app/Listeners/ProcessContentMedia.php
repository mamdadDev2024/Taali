<?php

namespace Modules\Content\Listeners;

use Modules\Content\Events\ContentCreated;
use Modules\Media\Models\Media;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use FFMpeg;

class ProcessContentMedia implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ContentCreated $event)
    {
        $content = $event->content;
        $mediaData = $event->mediaData;

        foreach ($mediaData['images'] ?? [] as $image) {
            $path = $image->store('images', 'public');

        //    Image::make(Storage::disk('public')->path($path))->resize(1200, 800)->save();

            $content->media()->create([
                'type' => 'image',
                'path' => $path,
                'name' => $image->getClientOriginalName(),
                'metadata' => ['width' => 1200, 'height' => 800],
            ]);
        }

        foreach ($mediaData['audios'] ?? [] as $audio) {
            $path = $audio->store('audios', 'public');

            $duration = FFMpeg::open(Storage::disk('public')->path($path))->getDurationInSeconds();

            $content->media()->create([
                'type' => 'audio',
                'path' => $path,
                'name' => $audio->getClientOriginalName(),
                'metadata' => ['duration' => $duration],
            ]);
        }

        foreach ($mediaData['videos'] ?? [] as $videoUrl) {
            $content->media()->create([
                'type' => 'video',
                'path' => $videoUrl,
                'metadata' => ['source' => 'aparat'],
            ]);
        }
    }
}
