<x-slot name="header">
    <x-header>
        {{ __('Type Investiment') }}
    </x-header>
</x-slot>
<x-container>
    <form wire:submit.prevent="save" >
        <div class="flex flex-1 gap-3 flex-row justify-between items-center">
            <div class="flex-1">
                <label for="name" class="label-default  @error('form.name') label-default-error @enderror">
                    Type  Investiment
                </label>
                <input
                        wire:model="form.name"
                        id="name"   class=" input-default @error('form.name')  input-default-error @enderror"
                        type="text"/>

            </div>
            <div>
                <label for="percentage" class=" label-default @error('form.percentage') label-default-error @enderror">
                    {{__('Percentage')}}
                </label>
                <input type="number" id="percentage" aria-placeholder="10" aria-describedby="helper-text-explanation"
                       class="input-default @error('form.percentage') input-default-error @enderror"
                       placeholder="10"
                       wire:model="form.percentage"/>
            </div>
            <div>
                <label for="number-input" class="block mb-2 text-sm">&nbsp;</label>
                <x-primary-button class="py-3">Save</x-primary-button>

            </div>
        </div>
    </form>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-12">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('name')">
                    <div class="flex items-center ">
                        Type Investiment
                        <x-order-table :sortBy="$sortBy" :order="$order" column="name" class="ml-2"/>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3  cursor-pointer"  wire:click="sort('percentage')">
                    <div class="flex items-center">
                        Percentage
                        <x-order-table :sortBy="$sortBy" :order="$order" column="percentage" class="ml-2"/>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($typeInvestiments as $type)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$type->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$type->percentage.'%'}}
                    </td>
                    <td class="px-6 py-4">
                        <x-secondary-button wire:key="{{$type->id}}" wire:click="edit({{$type}})">Edit</x-secondary-button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-container>