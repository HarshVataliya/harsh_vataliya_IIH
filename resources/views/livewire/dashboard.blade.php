{{-- <x-app-layout> --}}
    <x-slot name="header">
        <div class="">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Student Details') }}
        </h2>


    </div>
</x-slot>

<div class="py-12 ">

    <div class="justify-center mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-button outline primary label="Add Student" wire:click="create"/>
            <div class="mt-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">First Name</th>
                                <th class="px-4 py-2">Last Name</th>
                                <th class="px-4 py-2">Date of Birth</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ $students }}hey
                            {{-- @foreach ($students as $student)
                            <tr>
                                <td class="px-4 py-2 border">{{ $student->id }}</td>
                                <td class="px-4 py-2 border">{{ $student->first_name }}</td>
                                <td class="px-4 py-2 border">{{ $student->last_name }}</td>
                                <td class="px-4 py-2 border">{{ $student->date_of_birth }}</td>
                                <td class="px-4 py-2 border">
                                    <button wire:click="edit({{ $student->id }})" class="px-2 py-1 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                        Edit
                                    </button>
                                    <button wire:click="onDelete({{ $student->id }})" class="px-2 py-1 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <x-modal.card :title="$showModalTitle" blur wire:model.defer="showEditModal">
            <form>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-input wire:model.defer="editing.first_name" label="First Name" placeholder="First name" />
                    <x-input wire:model.defer="editing.last_name" label="Last Name" placeholder="Last name" />
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-input type="date" wire:model.defer="editing.dob" label="Due Date" />
                    <div class="grid grid-cols-1 gap-4 align-middle sm:grid-cols-2">
                        <x-radio label="Male" wire:model.defer="editing.gender" value="male"/>
                        <x-radio label="Female" wire:model.defer="editing.gender" value="female"/>
                    </div>
                </div>
                {{-- <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                    <x-inputs.number label="Maths" wire:model.defer="editing.marks"/>
                    <x-inputs.number label="Physics" wire:model.defer="editing.marks"/>
                    <x-inputs.number label="Chemistry" wire:model.defer="editing.marks"/>
                </div> --}}

                <x-slot name="footer">
                    <div class="flex justify-between gap-x-4">
                        <x-button flat negative label="Delete" wire:click="delete" class="rounded-lg" />

                        <div class="flex space-x-2">
                            <x-button flat label="Cancel" x-on:click="close" class="rounded-lg" />
                            <x-button primary label="Save" wire:click="save" class="rounded-lg" />
                        </div>
                    </div>
                </x-slot>
            </form>
            </x-modal.card>
    </div>


    {{-- <x-wire-ui-modal :isOpen="$isOpen">
        <livewire:add-student />
    </x-wire-ui-modal> --}}
{{-- </x-app-layout> --}}
