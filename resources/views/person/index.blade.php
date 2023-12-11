<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-section-header>
                {{ __('People') }}
            </x-section-header>
            <form action="{{ route('person.search') }}" method="GET">
                <input class="rounded-md dark:text-gray-700" type="text" name="search" required />
                <button class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                    type="submit">{{ __("Search") }}</button>
            </form>
        </div>
        <x-notification />
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700 dark:text-white">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('person.index', ['order' => 'asc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18" />
                                </svg>
                            </a>
                            <a href="{{ route('person.index', ['order' => 'desc']) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3" />
                                </svg>
                            </a>
                        </div>
                        <div>
                            <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                            href="{{ route('people.downloadPDF') }}" target="_blank">{{ __("Get") }} PDF</a>
                            <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                            href="{{ route('person.create') }}">{{ __("Add Person") }}</a>
                        </div>

                    </div>

                    <table class="table-fixed border-separate border-spacing-6">
                        <thead>
                            <x-table-row>
                                <th>{{ __("Name") }}</th>
                                <th>{{ __("Email") }}</th>
                                <th>{{ __("Phone") }}</th>
                                <th>{{ __("Business") }}</th>
                                <th>{{ __("Tags") }}</th>
                                <th>{{ __("Actions") }}</th>
                            </x-table-row>
                        </thead>
                        <tbody>
                            @forelse ($people as $person)
                                <x-table-row>
                                    <td><a href="{{ route('person.show', $person->id) }}"
                                            class="text-blue-700 dark:text-blue-500 font-bold hover:bg-yellow-300 py-2 px-2 rounded-full">
                                            {{ $person->firstname }} {{ $person->lastname }}</a></td>
                                    <td>{{ $person->email }}</td>
                                    <td>{{ $person->phone }}</td>
                                    <td class="{{ $person->business?->deleted_at ? 'italic' : 'non-italic' }}">
                                        {{ $person->business?->business_name }}</td>
                                    <td>
                                        @foreach ($person->tags as $tag)
                                            <span class="bg-green-500 py-1 px-1 rounded-full">
                                                <a
                                                    href="{{ route('person.getByTag', $tag->tag_name) }}">{{ $tag->tag_name }}</a>
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('person.edit', $person->id) }}"
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
                                    <td>{{ __('No people found') }}</td>
                                </x-table-row>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $people->links() }} --}}
                    {{ $people->appends(['order' => $order])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
