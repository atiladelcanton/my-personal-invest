<x-slot name="header">
    <x-header>
        {{ __('Actions') }}
    </x-header>
</x-slot>
<x-container>
    <div class="flex flex-1 gap-3 flex-row justify-end items-center">
        <x-primary-button class="py-3" data-modal-target="crud-action" data-modal-toggle="crud-action" type="button">
            <svg class="w-4 h-4 mr-2 text-white dark:text-gray-800" aria-hidden="true"
                 width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
            </svg>
            New Action
        </x-primary-button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-12">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer" >
                        <div class="flex items-center ">
                            Category
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('active_code')">
                        <div class="flex items-center ">
                            Active
                            <x-order-table :sortBy="$sortBy" :order="$order" column="active_code" class="ml-2"/>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('price')">
                        <div class="flex items-center ">
                            Price
                            <x-order-table :sortBy="$sortBy" :order="$order" column="price" class="ml-2"/>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer">
                        <div class="flex items-center ">
                            Dividend
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('total_quotas_contributed')">
                        <div class="flex items-center ">
                            Total Quotas
                            <x-order-table :sortBy="$sortBy" :order="$order" column="total_quotas_contributed" class="ml-2"/>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('magic_number ')">
                        <div class="flex items-center ">
                            Magic Number
                            <x-order-table :sortBy="$sortBy" :order="$order" column="magic_number " class="ml-2"/>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" >
                        <div class="flex items-center ">
                            Missing
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3 cursor-pointer" >
                        <div class="flex items-center ">
                            Actions
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
            @forelse($actions as $key => $action)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" wire:key="{{$action->id}}">
                    <td class="px-6 py-4">{{$action->typeInvestiment->name}}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center rounded-md bg-gray-400/10 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-gray-400/20">
                            {{$action->active_code}} - {{$action->type}}
                        </span>
                        </td>
                    <td class="px-6 py-4">R$ {{number_format($action->price,2,",",".")}}</td>
                    <td class="px-6 py-4">R$ {{number_format($action->last_dividend,2,",",".")}}</td>
                    <td class="px-6 py-4">{{$action->total_quotas_contributed}}</td>
                    <td class="px-6 py-4">{{$action->magic_number}}</td>
                    <td class="px-6 py-4">{{$action->total_quotas_contributed }}</td>
                    <td class="px-6 py-4">

                        <x-secondary-button wire:key="{{$action->id}}" wire:click="edit({{$action}})"  data-modal-target="crud-action" data-modal-toggle="crud-action">
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
                                wire:key="{{$action->id}}"
                                wire:click="delete({{$action->id}})"
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
            @empty

            @endforelse
            </tbody>
        </table>
    </div>
    <div id="crud-action" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0
    right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add new Action
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900
                    rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600
                     dark:hover:text-white" data-modal-toggle="crud-action">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select category</option>
                                <option value="TV">TV/Monitors</option>
                                <option value="PC">PC</option>
                                <option value="GA">Gaming/Console</option>
                                <option value="PH">Phones</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                            <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Add new product
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-container>