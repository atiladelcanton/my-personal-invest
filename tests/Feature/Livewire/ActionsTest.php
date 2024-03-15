<?php

use App\Livewire\Actions;
use App\Models\{Action, TypeInvestiment, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseCount};

it('should render list actions ', function () {
    $user = User::factory()->create();
    actingAs($user);
    $typeAction = TypeInvestiment::factory()->create([
        'user_id'    => $user->id,
        'name'       => 'Fundo Imobiliario',
        'percentage' => 10,
    ]);
    Action::create([
        'active_code'              => 'MXRF11',
        'type_investiment_id'      => $typeAction->id,
        'price'                    => 10.31,
        'last_dividend'            => 0.10,
        'total_quotas_contributed' => 0,
        'magic_number'             => 103,
        'missing_for_magic_number' => 103,
        'type'                     => 'Papel',
        'user_id'                  => $user->id,
    ]);
    Livewire::test(Actions::class)
            ->assertSee('MXRF11')
            ->assertSee('R$ 10,31')
            ->assertSee(103)
            ->assertSee('R$ 0,10');
});
it('checking form rules', function ($field, $value, $rule) {
    $user = User::factory()->create();
    actingAs($user);
    Livewire::test(Actions::class)->set($field, $value)->call('save')->assertHasErrors([$field => $rule]);
})->with([
    'active_code.required'              => ['field' => 'active_code', 'value' => '', 'rule' => 'required'],
    'type_investiment_id.required'      => ['field' => 'type_investiment_id', 'value' => '', 'rule' => 'required'],
    'price.required'                    => ['field' => 'price', 'value' => '', 'rule' => 'required'],
    'total_quotas_contributed.required' => ['field' => 'total_quotas_contributed', 'value' => '', 'rule' => 'required', ],
    'type.required'                     => ['field' => 'type', 'value' => '', 'rule' => 'required'],
    'last_dividend.required'            => ['field' => 'last_dividend', 'value' => '', 'rule' => 'required'],
]);

it('should store the action', function () {
    $user = User::factory()->create();
    actingAs($user);
    $typeAction = TypeInvestiment::factory()->create([
        'user_id'    => auth()->user()->id,
        'name'       => 'Fundo Imobiliario',
        'percentage' => 10,
    ]);

    Livewire::test(Actions::class)
        ->set('form.active_code', 'MXRF11')
        ->set('form.type_investiment_id', $typeAction->id)
        ->set('form.price', 10.31)
        ->set('form.last_dividend', 0.10)
        ->set('form.total_quotas_contributed', 0)
        ->set('form.type', 'Papel')
        ->call('save')->assertHasNoErrors();

    assertDatabaseCount('actions', 1);
    \Pest\Laravel\assertDatabaseHas('actions', [
        'active_code'              => 'MXRF11',
        'type_investiment_id'      => $typeAction->id,
        'price'                    => 10.31,
        'last_dividend'            => 0.10,
        'total_quotas_contributed' => 0,
        'magic_number'             => 103,
        'missing_for_magic_number' => 103,
        'type'                     => 'Papel',
    ]);
});
