<?php

namespace App\Livewire;

use App\Livewire\Forms\ActionForm;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Actions extends Component
{
    public ActionForm $form;
    public function render(): View
    {
        return view('livewire.actions');
    }

    public function save()
    {

        $this->form->save();
        $this->form->reset();
    }
}
