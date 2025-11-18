<?php

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Media\Enums\MediaTypeEnum;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'type',
        'size',
        'mime_type',
        'disk',
        'metadata',
    ];

    protected $casts = [
        'type' => MediaTypeEnum::class,
        'metadata' => 'array',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
