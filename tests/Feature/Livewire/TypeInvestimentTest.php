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
it('should store type investment by user', function () {
    $user = User::factory()->create();
    actingAs($user);

    Livewire::test(TypeIvenstiment::class)
            ->set('form.name', 'Fundo Emergency')
            ->set('form.percentage', 40)
            ->set('user_id', $user->id)
            ->call('save');

    assertDatabaseHas('type_investiments', [
        'name'       => 'Fundo Emergency',
        'percentage' => 40,
        'user_id'    => $user->id,
    ]);
});

it('should showing alert message with percentage grantest One Hundred store', function () {
    $user = User::factory()->create();
    actingAs($user);

    for ($i = 0; $i < 2; $i++) {
        Livewire::test(TypeIvenstiment::class)
            ->set('form.name', 'Fundo Emergency ' . $i)
            ->set('form.percentage', 40)
            ->set('user_id', $user->id)
            ->call('save');
    }
    Livewire::test(TypeIvenstiment::class)
        ->set('form.name', 'Fundo Emergency')
        ->set('form.percentage', 80)
        ->set('user_id', $user->id)
        ->call('save')
        ->assertHasErrors(['invalidPercentage']);
});
