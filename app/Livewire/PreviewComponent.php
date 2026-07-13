<?php

namespace App\Livewire;

use App\Models\Fact;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class PreviewComponent extends Component
{
    public Fact $fact;

    public function mount(Fact $fact)
    {
        $this->fact = $fact->load([
            'category',
            'tags',
            'images',
        ]);
    }

    public function render()
    {
        return view('livewire.fact');
    }
}