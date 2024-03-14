<?php

namespace App\Livewire;

use App\Livewire\Forms\TypeIvenstimentForm;
use App\Models\{TypeInvestiment, TypeInvestiment as TypeInvestimentModel};
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\View\View;
use Livewire\Component;

class TypeIvenstiment extends Component
{
    public ?string $order = 'asc';

    public ?string $sortBy = null;

    public TypeIvenstimentForm $form;

    protected mixed $queryString = [
        'order'  => ['except' => ''],
        'sortBy' => ['except' => ''],
    ];

    public function render(
    ): View {
        return view('livewire.type-investiment', [
            'typeInvestiments' => $this->getInvestiments(),
        ]);
    }

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->order = $this->order == 'asc' ? 'desc' : 'asc';
        } else {
            $this->order = 'asc';
        }
        $this->sortBy = $column;
    }

    public function save(): void
    {
        $sumPercentage = TypeInvestimentModel::query()->where('user_id', auth()->user()->id)->sum('percentage');

        if(is_null($this->form->id)) {
            $sum = $sumPercentage += intval($this->form->percentage);

            if (intval($sum) > TypeInvestimentModel::TOTAL_PERCENTAGE) {
                $this->addError('invalidPercentage', 'Seu percentual está passando de 100% no total');

                return;
            }
        } else {
            $typeInvestiment = TypeInvestimentModel::query()->find($this->form->id);

            if($typeInvestiment->percentage < intval($this->form->percentage)) {
                $sum = $sumPercentage += intval($this->form->percentage);

                if (intval($sum) > TypeInvestimentModel::TOTAL_PERCENTAGE) {
                    $this->addError('invalidPercentage', 'Seu percentual está passando de 100% no total');

                    return;
                }
            }
        }
        $this->form->save();
        $this->form->reset();

    }

    public function edit(TypeInvestimentModel $typeInvestiment): void
    {
        $this->form->setInvestiment($typeInvestiment);
    }

    public function delete(int $id): void
    {
        $investment = TypeInvestimentModel::find($id);

        if ($investment->user_id === auth()->user()->id) {
            $investment->delete();
        } else {
            abort(403);
        }
    }

    public function getInvestiments(): \Illuminate\Database\Eloquent\Collection
    {
        return TypeInvestimentModel::where('user_id', auth()->user()->id)->when(
            $this->sortBy,
            function (Builder $builder) {
                return $builder->orderBy($this->sortBy, $this->order);
            }
        )->get();
    }
}
