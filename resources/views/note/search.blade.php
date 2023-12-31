<x-app-layout>
    <x-slot name="header">
        <x-section-header class="inline-flex">
            <a class="flex justify-left items-center mr-2" href="{{ URL::previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </a>
            {{ __('Notes. Search result ror ') }} <span class="italic ml-2">"{{ $search }}"</span>
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700 dark:text-white">
                <div class="p-6 text-gray-900">

                    @if ($notes->isNotEmpty())
                        <table class="table-fixed border-separate border-spacing-6 dark:text-white hidden md:block">
                            <thead>
                                <tr>
                                    <th>{{ __("Title") }}</th>
                                    <th>{{ __("Keywords") }}</th>
                                    <th>{{ __("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notes as $note)
                                    <tr>
                                        <td>
                                            <x-buttons.show-button href="{{ route('note.show', $note->id) }}">
                                                {{ $note->title }}
                                            </x-buttons.show-button>
                                        </td>
                                        <td>
                                            @foreach ($note->tags as $tag)
                                                <span class="bg-green-500 py-1 px-1 rounded-full">
                                                    <a
                                                        href="{{ route('note.getByTag', $tag->tag_name) }}">{{ $tag->tag_name }}</a>
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('note.edit', $note->id) }}"
                                                class="flex justify-center items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6 hover:text-green-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 mb-4 md:hidden">
                            @forelse ($notes as $note)
                            <div class="bg-white space-y-3 p-4 rounded-lg shadow-orange-300">
                                <div class="flex items-center space-x-2 text-sm">
                                    <div>
                                        <x-buttons.show-button href="{{ route('note.show', $note->id) }}">
                                            {{ $note->title }}
                                        </x-buttons.show-button>
                                    </div>
                                    <div>
                                        @foreach ($note->tags as $tag)
                                            <span class="bg-green-500 py-1 px-1 rounded-full">
                                                <a
                                                    href="{{ route('note.getByTag', $tag->tag_name) }}">{{ $tag->tag_name }}</a>
                                            </span>
                                        @endforeach
                                    </div>
                                    <div>
                                        <a href="{{ route('note.edit', $note->id) }}"
                                            class="flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 hover:text-green-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            @empty

                            <div class="bg-white space-y-3 p-4 rounded-lg shadow-orange-300">
                                <div class="flex items-center space-x-2 text-sm">
                                    <div>

                                        {{ __('No results') }}

                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>

                        {{ $notes->links() }}
                    @else
                        <div>
                            <h2 class="dark:text-white">{{ __("No results") }}</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
