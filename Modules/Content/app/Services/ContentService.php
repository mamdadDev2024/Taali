<?php

namespace Modules\Content\Services;

use App\Contracts\BaseService;
use Modules\Content\Actions\ContentCreateAction;
use Modules\Content\Models\Content;

class ContentService extends BaseService
{
    public function __construct(private ContentCreateAction $createAction){}
    public function index() {}
    public function get() {}
    public function delete() {}
    public function update() {}
    public function create(array $payload)
    {
        return $this->execute(fn() => $this->createAction->handle($payload));
    }
}
