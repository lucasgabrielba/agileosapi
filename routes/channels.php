<?php

use Domains\Organizations\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('organizations.{organizationId}.users.{userId}', function (User $user, $organizationId, $userId) {
    return $user->organization->id === $organizationId && $user->id === $userId;
});
