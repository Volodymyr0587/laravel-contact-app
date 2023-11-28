<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex">
            <a class="flex justify-left items-center mr-2" href="{{ URL::previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </a>
            {{ __('People. Search result ror ') }} <span class="italic">"{{ $search }}"</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($people->isNotEmpty())
                        <table class="table-fixed border-separate border-spacing-6">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Business</th>
                                    <th>Tags</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($people as $person)
                                    <tr>
                                        <td><a href="{{ route('person.show', $person->id) }}"
                                                class="text-blue-700 font-bold hover:bg-yellow-300 py-2 px-2 rounded-full">
                                                {{ $person->firstname }} {{ $person->lastname }}</a></td>
                                        <td>{{ $person->email }}</td>
                                        <td>{{ $person->phone }}</td>
                                        <td class="{{ $person->business?->deleted_at ? 'italic' : 'non-italic' }}">
                                            {{ $person->business?->business_name }}</td>
                                        <td>
                                            @foreach ($person->tags as $tag)
                                                <span
                                                    class="bg-green-500 py-1 px-1 rounded-full">{{ $tag->tag_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('person.edit', $person->id) }}"
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
                        {{-- {{ $people->links() }} --}}
                    @else
                        <div>
                            <h2>No results</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>