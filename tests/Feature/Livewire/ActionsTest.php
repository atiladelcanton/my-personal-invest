<?php

use App\Livewire\Actions;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Actions::class)->assertStatus(200);
});

it('should store action', function () {
})
->with(
    [
        'active_code.required'              => ['field' => 'active_code', 'value' => '', 'rule' => 'required'],
        'price.required'                    => ['field' => 'price', 'value' => '', 'rule' => 'required'],
        'recommended_percentage.required'   => ['field' => 'recommended_percentage', 'value' => '', 'rule' => 'required'],
        'magic_number.required'             => ['field' => 'magic_number', 'value' => '', 'rule' => 'required'],
        'total_quotas_contributed.required' => ['field' => 'total_quotas_contributed', 'value' => '', 'rule' => 'required'],
        'missing_for_magic_number.required' => ['field' => 'missing_for_magic_number', 'value' => '', 'rule' => 'required'],
        'type.required'                     => ['field' => 'type', 'value' => '', 'rule' => 'required'],
    ]
);
