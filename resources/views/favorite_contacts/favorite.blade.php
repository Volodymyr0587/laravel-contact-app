<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-section-header>
                {{ __('Favorite contacts') }}
            </x-section-header>
        </div>
        <x-notification />
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700 dark:text-white">
                <div class="p-6 text-gray-900">

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
                                            <x-buttons.show-button href="{{ route('person.show', $favContact->id) }}">
                                                {{ $favContact->firstname }} {{ $favContact->lastname }}
                                            </x-buttons.show-button>
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
                                            <x-buttons.show-button href="{{ route('business.show', $favContact->id) }}">
                                            {{ $favContact->business_name }}</x-buttons.show-button>
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
