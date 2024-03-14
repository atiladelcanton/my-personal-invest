<?php

use App\Livewire\Actions;
use App\Models\{TypeInvestiment, User};
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;

it('renders successfully', function () {
    Livewire::test(Actions::class)->assertStatus(200);
});

it('checking form rules', function ($field, $value, $rule) {
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
    \Pest\Laravel\actingAs($user);
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
it('should update the action', closure: function () {
    $user = User::factory()->create();
    \Pest\Laravel\actingAs($user);
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
    $action = \App\Models\Action::query()->where('active_code','MXRF11')->first();
});
