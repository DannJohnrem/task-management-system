<x-app-layout>
    <x-slot name="header">
        {{ 'Edit task' }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('task.update', $task->id) }}" method="POST" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="block w-full mt-1" required  value="{{ $task->title }}"/>
                <x-input-error :messages="$errors->updatePassword->get('title')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-text-area id="description" name="description" class="block w-full mt-1" required>{{ $task->description }}</x-text-area>
                <x-input-error :messages="$errors->updatePassword->get('description')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="due_date" :value="__('Due Date')" />
                <x-text-input id="due_date" name="due_date" type="date" class="block w-full mt-1" required  value="{{ $task->due_date }}"/>
                <x-input-error :messages="$errors->updatePassword->get('due_date')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="category" :value="__('Category')" />
                <x-text-input id="category" name="category" type="text" class="block w-full mt-1" required  value="{{ $task->category }}"/>
                <x-input-error :messages="$errors->updatePassword->get('category')" class="mt-2" />
            </div>
            {{-- <button type="submit" class="btn btn-primary">Create Task</button> --}}

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Edit Task') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
