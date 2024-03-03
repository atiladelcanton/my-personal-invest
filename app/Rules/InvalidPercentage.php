<?php

namespace App\Rules;

use App\Models\TypeInvestiment as TypeInvestimentModel;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class InvalidPercentage implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

//        $typeInvestiment = TypeInvestimentModel::query()->find($this->form->id);
//
//
//        if($typeInvestiment->percentage != $this->form->percentage)
//        {
//            $sumPercentage = TypeInvestimentModel::query()->where('user_id',auth()->user()->id)->sum('percentage');
//            $sumPercentage = $sumPercentage = $this->form->percentage;
//            if(intval($sumPercentage) > TypeInvestimentModel::TOTAL_PERCENTAGE){
//                $this->addError('invalidPercentage', 'Seu percentual está passando de 100% no total');
//            }
//        }
    }
}
