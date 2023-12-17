<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-section-header>
                {{ __('People') }}
            </x-section-header>
            <form action="{{ route('person.search') }}" method="GET">
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
                            <x-action-button>
                                <a href="{{ route('people.downloadPDF') }}" target="_blank">{{ __("Get") }} PDF</a>
                            </x-action-button>
                            <x-action-button>
                                <a href="{{ route('person.create') }}">{{ __("Add Person") }}</a>
                            </x-action-button>
                        </div>

                    </div>

                    <table class="table-fixed border-separate border-spacing-6">
                        <thead>
                            <x-table-row>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                    </svg>
                                </th>
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
                                    <td>
                                        <span>
                                            @if (!empty($person->image))
                                                <img class="object-contain object-left h-10 w-10"
                                                src="{{ is_url($person->image) ? $person->image : Storage::url($person->image) }}"
                                                alt="Photo">
                                            @else
                                                {{-- Use default image --}}
                                                <img class="object-contain object-left h-10 w-10"
                                                src="{{ asset('images/person-no-image.png') }}" alt="Default photo">
                                            @endif
                                        </span>
                                    </td>
                                    <td><a href="{{ route('person.show', $person->id) }}"
                                            class="text-blue-700 dark:text-blue-500 font-bold hover:bg-yellow-300 py-2 px-2 rounded-full">
                                            {{ $person->firstname }} {{ $person->lastname }}</a></td>
                                    <td>{{ $person->email }}</td>
                                    <td>{{ $person->phone }}</td>
                                    <td class="{{ $person->business?->deleted_at ? 'italic' : 'non-italic' }}">
                                        {{ $person->business?->business_name }}</td>
                                    <td>
                                        @foreach ($person->tags as $tag)
                                            <span class="py-1 px-1 rounded-full"
                                                  style="background-color: {{ $tag->color ?? '#2d9f2f' }}">
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
