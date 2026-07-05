<?php

namespace App\Livewire;

use App\Models\Fact;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class OverviewComponent extends Component
{
    public function createFact(): void
    {
        $fact = Fact::create([
            'title' => 'Title',
        ]);

        $this->redirectRoute('fact.edit', ['id' => $fact->id]);
    }

    public function render()
    {
        return view('livewire.overview', [
            'facts' => Fact::latest()->get(),
        ]);
    }
}