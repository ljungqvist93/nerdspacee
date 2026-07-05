<?php

use Illuminate\Support\Facades\Broadcast;

use Illuminate\Support\Facades\Log;

Broadcast::channel('smash.{id}', function ($user, $id) {

    $exists = $user->smashes()
        ->where('smash_id', $id)
        ->exists();

    if (!$exists) {
        return false;
    }

    return [
        'id' => $user->id,
        'name' => $user->name,
        'image' => $user->image
    ];
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});