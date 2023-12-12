<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-section-header>
                {{ __('Notes') }}
            </x-section-header>
            <form action="{{ route('note.search') }}" method="GET">
                <input class="rounded-md dark:text-gray-700" type="text" name="search" required />
                <x-primary-button type="submit">{{ __("Search") }}</x-primary-button>
            </form>
        </div>
        <x-notification />
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700 dark:text-white">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-end">
                        <x-action-button>
                            <a href="{{ route('note.create') }}">{{ __("Add Note") }}</a>
                        </x-action-button>
                    </div>

                    <table class="table-fixed border-separate border-spacing-6">
                        <thead>
                            <x-table-row>
                                <th>{{ __("Title") }}</th>
                                <th>{{ __("Keywords") }}</th>
                                <th>{{ __("Actions") }}</th>
                            </x-table-row>
                        </thead>
                        <tbody>
                            @forelse ($notes as $note)
                                <x-table-row>
                                    <td class="inline-flex">
                                        @if ($note->is_active)
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                            </svg>
                                        @endif
                                        <a href="{{ route('note.show', $note->id) }}"
                                            class="text-blue-700 font-bold dark:text-blue-500 hover:bg-yellow-300 py-2 px-2 rounded-full">
                                            {{ $note->title }}</a>
                                    </td>
                                    <td>
                                        @foreach ($note->tags as $tag)
                                            <a href="{{ route('note.getByTag', $tag->tag_name) }}"
                                                class="bg-green-500 py-1 px-1 rounded-full">
                                                {{ $tag->tag_name }}
                                            </a>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('note.edit', $note->id) }}"
                                            class="flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 hover:text-green-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                    </td>
                                </x-table-row>
                            @empty
                                <x-table-row>
                                    <td>{{ __('No notes found') }}</td>
                                </x-table-row>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $notes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
