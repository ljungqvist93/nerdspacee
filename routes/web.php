<?php

use App\Models\Fact;
use App\Livewire\FactComponent;
use App\Livewire\OverviewComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\EditComponent;

Route::get('/', function () {
    $fact = Fact::inRandomOrder()->firstOrFail();

    return redirect()->route('fact.show', $fact);
});

Route::get('/fact', FactComponent::class)->name('fact');
Route::get('/fact/{fact}', FactComponent::class)->name('fact.show');

Route::middleware('auth')->group(function () {
    Route::get('/fact/{id}/edit', EditComponent::class)
        ->name('fact.edit');

    Route::get('/overview', OverviewComponent::class)
        ->name('overview');
});

require __DIR__ . '/auth.php';