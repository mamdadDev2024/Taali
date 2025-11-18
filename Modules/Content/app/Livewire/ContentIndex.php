<?php

namespace Modules\Content\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;



#[Layout('components.layouts.master')]
#[Title('Content List')]
class ContentIndex extends Component
{
    public function render()
    {
        return view('content::livewire.content-index');
    }
}
