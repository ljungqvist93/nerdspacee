<?php

namespace App\Livewire;

use App\Models\Fact;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class FactComponent extends Component
{
    public Fact $fact;

    public function mount($id)
    {
        $this->fact = Fact::with([
            'category',
            'tags',
            'images',
        ])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.fact');
    }
}