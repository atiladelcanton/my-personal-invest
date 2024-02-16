<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TypeIvenstiment;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas, get};

it('should render sucessul component Type Investiment', function () {
    $user = User::factory()->create();
    actingAs($user);
    Livewire::test(TypeIvenstiment::class)->assertStatus(200);
    get(route('type_investiments'))->assertSeeLivewire(TypeIvenstiment::class);
});
it('should store type investiment by user', function () {
    $user = User::factory()->create();
    actingAs($user);
    \App\Models\TypeInvestiment::create([
        'name'       => 'Fundo Emergencia',
        'percentage' => 60,
        'user_id'    => $user->id,
    ]);
    assertDatabaseHas('type_investiments', [
        'name'       => 'Fundo Emergencia',
        'percentage' => 60,
        'user_id'    => $user->id,
    ]);
});
