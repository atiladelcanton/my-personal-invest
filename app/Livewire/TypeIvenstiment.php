<?php

namespace App\Livewire;

use App\Livewire\Forms\TypeIvenstimentForm;
use App\Models\TypeInvestiment as TypeInvestimentModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;

class TypeIvenstiment extends Component
{
    public ?string $order = 'asc';

    public ?string $sortBy = null;

    public TypeIvenstimentForm $form;

    protected $queryString = [
        'order'  => ['except' => ''],
        'sortBy' => ['except' => ''],
    ];

    public function render(
    ): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|Factory|View|Application {
        return view('livewire.type-investiment', [
            'typeInvestiments' => TypeInvestimentModel::where('user_id', auth()->user()->id)->when(
                $this->sortBy,
                function (Builder $builder) {
                    return $builder->orderBy($this->sortBy, $this->order);
                }
            )->get(),
        ]);
    }


    public function sort($column): void
    {
        if ($this->sortBy === $column) {
            $this->order = $this->order == 'asc' ? 'desc' : 'asc';
        } else {
            $this->order = 'asc';
        }
        $this->sortBy = $column;
    }

    public function save()
    {
        $this->form->save();
    }

    public function edit(TypeInvestimentModel $typeInvestiment)
    {
        $this->name       = $typeInvestiment->name;
        $this->percentage = $typeInvestiment->percentage;

    }
}