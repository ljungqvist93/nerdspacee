<?php

namespace App\Livewire;

use App\Models\Fact;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class FactComponent extends Component
{
    public Fact $fact;

    /**
     * @var \App\Models\Fact[]
     */
    public array $queue = [];

    public array $recentFactIds = [];

    protected int $queueSize = 5;

    public function mount(Fact $fact)
    {
        $this->fact = $fact->load([
            'category',
            'tags',
            'images',
        ]);

        $this->recentFactIds[] = $this->fact->id;

        $this->fillQueue();
    }

    public function randomFact(): void
    {
        if (empty($this->queue)) {
            $this->fillQueue();

            if (empty($this->queue)) {
                return;
            }
        }

        $this->fact = array_shift($this->queue);

        $this->recentFactIds[] = $this->fact->id;

        $this->recentFactIds = array_slice($this->recentFactIds, -50);

        $this->fillQueue();

        $this->dispatch('fact-changed', url: route('fact.show', $this->fact->slug));
    }

    protected function fillQueue(): void
    {
        while (count($this->queue) < $this->queueSize) {

            $exclude = array_merge(
                $this->recentFactIds,
                collect($this->queue)->pluck('id')->all(),
                [$this->fact->id]
            );

            $fact = Fact::whereHas('images')
                ->whereNotIn('id', $exclude)
                ->with([
                    'category:id,name,color,icon',
                    'tags:id,name',
                    'images:id,fact_id,name',
                ])
                ->inRandomOrder()
                ->first();

            if (!$fact) {
                break;
            }

            $this->queue[] = $fact;
        }
    }

    public function render()
    {
        return view('livewire.fact');
    }
}