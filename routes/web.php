<?php

use App\Livewire\FactComponent;
use App\Livewire\OverviewComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\EditComponent;

Route::get('/', FactComponent::class);

Route::get('/fact', FactComponent::class)->name('fact');
Route::get('/fact/{id}', FactComponent::class)->name('fact.show');

Route::middleware('auth')->group(function () {
    Route::get('/fact/{id}/edit', EditComponent::class)
        ->name('fact.edit');
    Route::get('/overview', OverviewComponent::class)->name('overview');
});

require __DIR__ . '/auth.php';