<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-section-header>
                {{ __('Deleted contacts') }}
            </x-section-header>

        </div>
        <x-notification />
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700 dark:text-white">
                <div class="p-6 text-gray-900">

                    <table class="table-fixed border-separate border-spacing-6 hidden md:block">
                        <thead>
                            <x-table-row>
                                <th>{{ __("Name") }}</th>
                                <th>{{ __("Type") }}</th>
                                <th>{{ __("Actions") }}</th>
                            </x-table-row>
                        </thead>
                        <tbody>
                            @forelse ($trashedContacts as $delContact)
                                <x-table-row>
                                    @if ($delContact instanceof \App\Models\Person)
                                        <td>
                                            {{ $delContact->firstname }} {{ $delContact->lastname }}
                                        </td>
                                        <td class="font-mono tracking-widest">{{ __("Person") }}</td>
                                        <td>
                                            <a href="{{ route('person.restoreFromTrash', $delContact->id) }}">
                                                <x-action-button class="bg-green-400">
                                                    {{ __("Restore") }}
                                                </x-action-button>
                                            </a>
                                            <form action="{{ route('person.destroyPermanetly', $delContact->id) }}" method="POST"
                                                onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                @method('DELETE')

                                                <x-action-button class="bg-red-600">
                                                    {{ __("Delete Permanently") }}
                                                </x-action-button>
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            {{ $delContact->business_name }}
                                        </td>
                                        <td class="font-mono tracking-widest">{{ __("Business") }}</td>
                                        <td>
                                            <a href="{{ route('business.restoreFromTrash', $delContact->id) }}">
                                                <x-action-button class="bg-green-400">
                                                    {{ __("Restore") }}
                                                </x-action-button>
                                            </a>
                                            <form action="{{ route('business.destroyPermanetly', $delContact->id) }}" method="POST"
                                                onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                @method('DELETE')

                                                <x-action-button class="bg-red-600">
                                                    {{ __("Delete Permanently") }}
                                                </x-action-button>
                                            </a>
                                        </td>
                                    @endif
                                </x-table-row>
                            @empty
                                <x-table-row>
                                    <td>{{ __('Trash is empty') }}</td>
                                </x-table-row>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 mb-4 md:hidden">
                        @forelse ($trashedContacts as $delContact)
                        <div class="bg-white space-y-3 p-4 rounded-lg shadow-orange-300">
                            <div class="flex items-center space-x-2 text-sm">
                                <div>
                                    @if ($delContact instanceof \App\Models\Person)
                                        <div>
                                            {{ $delContact->firstname }} {{ $delContact->lastname }}
                                        </div>
                                        <div class="font-mono tracking-widest">{{ __("Person") }}</div>
                                        <div>
                                            <a href="{{ route('person.restoreFromTrash', $delContact->id) }}">
                                                <x-action-button class="bg-green-400">
                                                    {{ __("Restore") }}
                                                </x-action-button>
                                            </a>
                                            <form action="{{ route('person.destroyPermanetly', $delContact->id) }}" method="POST"
                                                onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                @method('DELETE')

                                                <x-action-button class="bg-red-600">
                                                    {{ __("Delete Permanently") }}
                                                </x-action-button>
                                            </a>
                                        </div>
                                    @else
                                        <div>
                                            {{ $delContact->business_name }}
                                        </div>
                                        <div class="font-mono tracking-widest">{{ __("Business") }}</div>
                                        <div>
                                            <a href="{{ route('business.restoreFromTrash', $delContact->id) }}">
                                                <x-action-button class="bg-green-400">
                                                    {{ __("Restore") }}
                                                </x-action-button>
                                            </a>
                                            <form action="{{ route('business.destroyPermanetly', $delContact->id) }}" method="POST"
                                                onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                @csrf
                                                @method('DELETE')

                                                <x-action-button class="bg-red-600">
                                                    {{ __("Delete Permanently") }}
                                                </x-action-button>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="bg-white space-y-3 p-4 rounded-lg shadow-orange-300">
                            <div class="flex items-center space-x-2 text-sm">
                                <div>

                                    {{ __('Trash is empty') }}

                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
