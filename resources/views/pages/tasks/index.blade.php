<x-app-layout>
    <x-slot name="header">
        <span>{{ __('Dashboard') }}</span>

        <a href="{{ route('task.create') }}"
            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>New Task</span>
        </a>
    </x-slot>


    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="w-full mb-8 overflow-hidden border rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Due date</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse ($tasks as $task)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ $task->title }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->description }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->due_date }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->category }}
                            </td>
                            <td class="px-4 py-4 text-xs">
                                <button class="font-semibold rounded-lg toggle-status" data-id="{{ $task->id }}"
                                    data-status="{{ $task->status == 'completed' ? 'completed' : 'pending' }}">
                                    @if($task->status == 'completed')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">
                                        Mark as Pending
                                    </span>
                                    @else
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                        Mark as Completed
                                    </span>

                                    @endif
                                </button>
                            </td>
                            <td class="flex items-center gap-1 px-4 py-3 text-sm justify-first">
                                <a class="text-green-500 hover:text-green-700"
                                    href="{{ route('task.edit', $task->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <form action="{{ route('task.destroy', $task->id) }}" method="POST"
                                    class="flex items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-lg font-bold text-center text-red-500">
                                No record found!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>


    @push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-status').click(function() {
                var button = $(this);
                var taskId = button.data('id');
                var currentStatus = button.data('status');

                $.ajax({
                    url: '/task/' + taskId + '/toggle-status',
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var newStatus = response.status;
                        button.data('status', newStatus);

                        if (newStatus === 'completed') {
                            button.text('Mark as Pending');
                            button.removeClass('px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full');
                            button.addClass('px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full');
                        } else {
                            button.text('Mark as Completed');
                            button.removeClass('px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full');
                            button.addClass('px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full');
                        }
                    },
                    error: function(xhr) {
                        console.log('Error', xhr.responseText);
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
