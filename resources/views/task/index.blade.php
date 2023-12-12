<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Tasks') }}
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700 dark:text-white">
                <div class="p-6 text-gray-900">

                    <table class="table-fixed border-separate border-spacing-6">
                        <thead>
                            <x-table-row>
                                <th>{{ __("Task Title") }}</th>
                                <th>{{ __("For") }}</th>
                                <th>{{ __("Status") }}</th>
                                <th>{{ __("Actions") }}</th>
                            </x-table-row>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <x-table-row>
                                    <td class="font-medium">{{ $task->title }}</td>
                                    <td>
                                        @if (str_contains($task->taskable_type, 'Business'))
                                            <span class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                                </svg>
                                                {{ $task->taskable?->business_name }}
                                            </span>
                                        @else
                                            <span class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                </svg>
                                                {{ $task->taskable?->firstname }} {{ $task->taskable?->lastname }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $task->status }}</td>
                                    <td>
                                        <form action="{{ route('task.complete', $task->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('PUT')
                                            <x-action-button type="submit">
                                                {{ __("Complete Task") }}
                                            </x-action-button>
                                        </form>
                                    </td>
                                </x-table-row>
                            @empty
                                <x-table-row>
                                    <td>{{ __('No tasks found') }}</td>
                                </x-table-row>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
