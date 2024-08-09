<x-app-layout>
    <x-slot name="header">
        {{ __('Create a New Task') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('task.store') }}" method="POST" class="mt-6 space-y-6">
            @csrf
            {{-- <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div> --}}
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="block w-full mt-1" required />
                <x-input-error :messages="$errors->updatePassword->get('title')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-text-area id="description" name="description" class="block w-full mt-1" required />
                <x-input-error :messages="$errors->updatePassword->get('description')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="due_date" :value="__('Due Date')" />
                <x-text-input id="due_date" name="due_date" type="date" class="block w-full mt-1" required />
                <x-input-error :messages="$errors->updatePassword->get('due_date')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="category" :value="__('Category')" />
                <x-text-input id="category" name="category" type="text" class="block w-full mt-1" required />
                <x-input-error :messages="$errors->updatePassword->get('category')" class="mt-2" />
            </div>
            {{-- <button type="submit" class="btn btn-primary">Create Task</button> --}}

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Create Task') }}</x-primary-button>
            </div>
        </form>
    </div>

</x-app-layout>
