<?php

namespace App\Livewire\Forms;

use App\Models\Action;
use Livewire\Attributes\{Locked, Validate};
use Livewire\Form;

class ActionForm extends Form
{
    #[Locked]
    public ?int $id = null;

    #[Validate('required|min:3')]
    public ?string $active_code = null;

    #[Validate('required')]
    public ?int $type_investiment_id = null;

    #[Validate('required')]
    public ?float $price = null;

    #[Validate('required')]
    public ?float $last_dividend = null;

    public ?int $magic_number = null;

    #[Validate('required')]
    public ?int $total_quotas_contributed = null;

    public ?int $missing_for_magic_number = null;

    #[Validate('required')]
    public ?string $type = null;

    public function save(): void
    {
        $this->validate();

        $this->calculateInformationsWithMagicNumber();
        Action::create([
            'user_id'                  => auth()->user()->id,
            'type_investiment_id'      => $this->type_investiment_id,
            'active_code'              => $this->active_code,
            'price'                    => $this->price,
            'last_dividend'            => $this->last_dividend,
            'magic_number'             => $this->magic_number,
            'total_quotas_contributed' => $this->total_quotas_contributed,
            'missing_for_magic_number' => $this->missing_for_magic_number,
            'type'                     => $this->type,
        ]);
    }

    /**
     * @return void
     */
    public function calculateInformationsWithMagicNumber(): void
    {
        $this->magic_number = calculateMagicNumber($this->price, $this->last_dividend);

        if (!is_null($this->missing_for_magic_number)) {
            $this->missing_for_magic_number = $this->missing_for_magic_number - $this->magic_number;
        } else {
            $this->missing_for_magic_number = $this->magic_number;
        }
    }
}
