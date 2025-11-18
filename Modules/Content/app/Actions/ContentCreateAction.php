<?php

namespace Modules\Content\Actions;

use Modules\Content\Models\Content;
use Modules\Content\Enums\ContentTypeEnum;
use Modules\Content\Events\ContentCreated;

class ContentCreateAction
{
    public function handle(array $payload): Content
    {
        $content = Content::create([
            'title'       => $payload['title'],
            'slug'        => $payload['slug'],
            'excerpt'     => $payload['excerpt'],
            'description' => $payload['description'] ?? null,
            'user_id'     => $payload['user_id'],
        ]);

        $this->storeMedia($content, $payload);

        ContentCreated::dispatch($content);

        return $content;
    }

    private function storeMedia(Content $content, array $payload): void
    {
        // ========== IMAGE ==========
        if (!empty($payload['image_url'])) {
            $content->media()->create([
                'type'     => ContentTypeEnum::IMAGE,
                'path'     => $payload['image_url'],
                'metadata' => ['original_url' => $payload['image_url']],
            ]);
        }

        // ========== AUDIO ==========
        if (!empty($payload['audio_url'])) {
            $content->media()->create([
                'type'     => ContentTypeEnum::AUDIO,
                'path'     => $payload['audio_url'],
                'metadata' => ['original_url' => $payload['audio_url']],
            ]);
        }

        // ========== VIDEO (Aparat) ==========
        if (!empty($payload['video_url'])) {
            $content->media()->create([
                'type'     => ContentTypeEnum::VIDEO,
                'path'     => $payload['video_url'],
                'metadata' => [
                    'original_url' => $payload['video_url'],
                    'service'      => 'aparat',
                ],
            ]);
        }
    }
}
