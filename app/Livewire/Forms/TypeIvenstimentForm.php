<?php

namespace App\Livewire\Forms;

use App\Models\TypeInvestiment as TypeInvestimentModel;
use Livewire\Attributes\{Locked, Validate};
use Livewire\Form;

class TypeIvenstimentForm extends Form
{
    #[Locked]
    public ?int $id = null;

    #[Validate('required|min:3')]
    public string $name = '';

    #[Validate(['required'])]
    public int $percentage = 0;

    public function save(): void
    {

        $this->validate();

        TypeInvestimentModel::updateOrCreate(['id' => $this->id], [
            'name'       => $this->name,
            'percentage' => intval($this->percentage),
            'user_id'    => auth()->user()->id,
        ]);
    }

    public function setInvestiment(TypeInvestimentModel $typeInvestiment): void
    {
        $this->id         = $typeInvestiment->id;
        $this->name       = $typeInvestiment->name;
        $this->percentage = $typeInvestiment->percentage;
    }
}
