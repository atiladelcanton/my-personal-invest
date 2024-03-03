<x-slot name="header">
    <x-header>
        {{ __('Type Investiment') }}
    </x-header>
</x-slot>
<x-container>
    @error('invalidPercentage')
        <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        {{$message}}
                    </p>
                </div>
            </div>
        </div>
    @enderror
    <form wire:submit.prevent="save" class="mt-2">
        <div class="flex flex-1 gap-3 flex-row justify-between items-center">
            <div class="flex-1">
                <label for="name" class="label-default  @error('form.name') label-default-error @enderror">
                    Type Investiment
                </label>
                <input
                        wire:model="form.name" name="name" id="name"
                        class=" input-default @error('form.name')  input-default-error @enderror"
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
                <input type="hidden" id="id" name="id" wire:model.live="form.id">
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
                <th scope="col" class="px-6 py-3  cursor-pointer" wire:click="sort('percentage')">
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
                        <x-secondary-button wire:key="{{$type->id}}" wire:click="edit({{$type}})">
                            <div class="flex items-center justify-between">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                </svg>

                                Edit
                            </div>
                        </x-secondary-button>
                        <x-danger-button
                                class="border border-warning"
                                type="button"
                                wire:click="delete({{$type->id}})"
                                wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"
                        >
                            <div class="flex items-center justify-between">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                </svg>

                                Delete
                            </div>
                        </x-danger-button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-container>