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

    protected int $bufferSize = 15;
    protected int $refillThreshold = 5;

    protected int $queueSize = 5;

    public function mount(?Fact $fact = null)
    {
        $query = Fact::whereHas('images')
            ->where('published', true)
            ->with([
                'category',
                'tags',
                'images',
            ]);

        if ($fact) {
            $this->fact = (clone $query)
                ->whereKey($fact->id)
                ->firstOrFail();
        } else {
            $this->fact = (clone $query)
                ->inRandomOrder()
                ->firstOrFail();
        }

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

        $id = (int) array_shift($this->queue);

        $this->fact = Fact::findOrFail($id)->load([
            'category',
            'tags',
            'images',
        ]);

        $this->recentFactIds[] = $this->fact->id;
        $this->recentFactIds = array_slice($this->recentFactIds, -50);

        if (count($this->queue) <= $this->refillThreshold) {
            $this->fillQueue();
        }

        $this->dispatch('fact-changed', url: route('fact.show', $this->fact->slug));
    }

    protected function fillQueue(): void
    {
        $historyReset = false;

        while (count($this->queue) < $this->queueSize) {

            $exclude = array_merge(
                $this->recentFactIds,
                $this->queue,
                [$this->fact->id]
            );

            $missing = $this->bufferSize - count($this->queue);

            $ids = Fact::whereHas('images')
                ->where('published', true)
                ->whereNotIn('id', $exclude)
                ->inRandomOrder()
                ->limit($missing)
                ->pluck('id')
                ->all();

            if (empty($ids)) {

                if ($historyReset) {
                    break;
                }

                $this->recentFactIds = [];
                $historyReset = true;

                continue;
            }

            $this->queue = array_merge($this->queue, $ids);
        }
    }

    public function render()
    {
        return view('livewire.fact');
    }
}