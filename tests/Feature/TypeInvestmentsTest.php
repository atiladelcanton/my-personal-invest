<?php

use App\Models\User;

it('should render page type investiments', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/type-investments');

    $response->assertRedirect(route('dashboard'));
});
