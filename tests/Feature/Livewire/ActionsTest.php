<?php

use App\Livewire\Actions;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Actions::class)
        ->assertStatus(200);
});
