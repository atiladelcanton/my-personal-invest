<?php

namespace App\Livewire;

use App\Livewire\Forms\ActionForm;
use App\Models\Action;
use App\Models\TypeInvestiment;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Actions extends Component
{
    public ActionForm $form;

    public ?string $order = 'asc';

    public ?string $sortBy = null;

    protected mixed $queryString = [
        'order'  => ['except' => ''],
        'sortBy' => ['except' => ''],
    ];
    public function render(): View
    {
        return view(
            'livewire.actions',
            [
                'actions' => Action::query()->where('user_id', auth()->user()->id)->get(),
                'typeInvestiments' => TypeInvestiment::query()->where('user_id', auth()->user()->id)->get(),
            ]
        );
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
    public function save()
    {

        $this->form->save();
        $this->form->reset();
    }

    public function delete(Action $action): void
    {
        if($action->user_id == auth()->user()->id) {
            $action->delete();
        } else {
            abort(403);
        }
    }

    public function edit(Action $action): void
    {
        $this->form->active_code = $action->active_code;
    }
}
