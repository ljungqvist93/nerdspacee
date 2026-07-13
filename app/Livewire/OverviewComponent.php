<?php

namespace App\Livewire;

use App\Models\Fact;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class OverviewComponent extends Component
{
    public function createFact(): void
    {
        $title = Str::random(12);

        $fact = Fact::create([
            'title' => $title,
            'slug' => Str::slug($title),
        ]);

        $this->redirectRoute('fact.edit', ['id' => $fact->id]);
    }

    public function render()
    {
        return view('livewire.overview', [
            'publishedFacts' => Fact::where('published', true)
                ->latest()
                ->get(),

            'unpublishedFacts' => Fact::where('published', false)
                ->latest()
                ->get(),
        ]);
    }
}