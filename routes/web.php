<?php

use App\Livewire\EditComponent;
use App\Livewire\FactComponent;
use App\Livewire\OverviewComponent;
use App\Livewire\PreviewComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', FactComponent::class)->name('home');
Route::get('/fact', FactComponent::class)->name('fact');
Route::get('/fact/{fact:slug}', FactComponent::class)->name('fact.show');

Route::middleware('auth')->group(function () {
    Route::get('/fact/{id}/edit', EditComponent::class)
        ->name('fact.edit');

    Route::get('/overview', OverviewComponent::class)
        ->name('overview');

    Route::get('/preview/{fact:slug}', PreviewComponent::class)
        ->name('fact.preview');
});

require __DIR__ . '/auth.php';