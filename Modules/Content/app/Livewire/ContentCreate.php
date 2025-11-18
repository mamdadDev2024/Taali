<?php

namespace Modules\Content\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Modules\Content\Services\ContentService;

class ContentCreate extends Component
{
    #[Validate('required|string|max:255')]
    public $title;

    #[Validate('required|string|max:255')]
    public $slug;

    #[Validate('required|string|max:1000')]
    public $excerpt;

    #[Validate('nullable|string')]
    public $description;

    #[Validate('required|in:article,video,audio,post')]
    public $type;

    #[Validate('nullable|image|max:10000')]
    public $image;

    #[Validate('nullable|file|mimes:.mp3|max:30000')]
    public $audio;

    #[Validate('nullable|url|max:500')]
    public $videoUrl;

    protected ContentService $service;

    public function boot(ContentService $service)
    {
        $this->service = $service;
    }

    public function save()
    {
        $this->validate();

        $this->service->create(
            payload: [
                'title'       => $this->title,
                'slug'        => $this->slug,
                'excerpt'     => $this->excerpt,
                'description' => $this->description,
                'type'        => $this->type,
                'user_id'     => auth('web')->id(),
                'image_url'   => $this->image,
                'audio_url'   => $this->audio,
                'video_url'   => $this->videoUrl,
            ]
        );

        Toaster::success(__('Content created and queued for processing!'));

        return $this->redirectRoute('content.index');
    }

    public function render()
    {
        return view('content::livewire.content-create');
    }
}
