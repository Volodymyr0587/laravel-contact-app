<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-section-header>
                {{ __('Favorite contacts') }}
            </x-section-header>
            {{-- <form action="{{ route('person.search') }}" method="GET">
                <input class="rounded-md dark:text-gray-700" type="text" name="search" required />
                <x-primary-button type="submit">{{ __("Search") }}</x-primary-button>
            </form> --}}
        </div>
        <x-notification />
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700 dark:text-white">
                <div class="p-6 text-gray-900">

                    {{-- <div class="flex items-center justify-between">
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

                    </div> --}}

                    <table class="table-fixed border-separate border-spacing-6">
                        <thead>
                            <x-table-row>
                                <th>{{ __("Name") }}</th>
                                <th>{{ __("Type") }}</th>
                                <th>{{ __("Actions") }}</th>
                            </x-table-row>
                        </thead>
                        <tbody>
                            @forelse ($favoriteContacts as $favContact)
                                <x-table-row>
                                    @if ($favContact instanceof \App\Models\Person)
                                        <td>
                                            <a href="{{ route('person.show', $favContact->id) }}"
                                            class="text-blue-700 dark:text-blue-500 font-bold hover:bg-yellow-300 py-2 px-2 rounded-full">
                                            {{ $favContact->firstname }} {{ $favContact->lastname }}</a>
                                        </td>
                                        <td class="font-mono tracking-widest">{{ __("Person") }}</td>
                                        <td>
                                            <form action="{{ route('person.markAsNormal', $favContact->id) }}" method="POST"
                                                onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                <x-action-button class="bg-red-400">
                                                    {{ __("Remove from Favorite") }}
                                                </x-action-button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('business.show', $favContact->id) }}"
                                            class="text-blue-700 dark:text-blue-500 font-bold hover:bg-yellow-300 py-2 px-2 rounded-full">
                                            {{ $favContact->business_name }}</form>
                                        </td>
                                        <td class="font-mono tracking-widest">{{ __("Business") }}</td>
                                        <td>
                                            <form action="{{ route('business.markAsNormal', $favContact->id) }}" method="POST"
                                                onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                <x-action-button class="bg-red-400">
                                                    {{ __("Remove from Favorite") }}
                                                </x-action-button>
                                            </form>
                                        </td>
                                    @endif
                                </x-table-row>
                            @empty
                                <x-table-row>
                                    <td>{{ __('No favorite contacts') }}</td>
                                </x-table-row>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $people->links() }} --}}
                    {{-- {{ $people->appends(['order' => $order])->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
