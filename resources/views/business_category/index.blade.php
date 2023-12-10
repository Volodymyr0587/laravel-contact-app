<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Business category') }}
        </x-section-header>
        <x-notification />
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700 dark:text-white">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-end">
                        <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                            href="{{ route('businessCategory.create') }}">Add Business Category</a>
                    </div>

                    <table class="table-fixed border-separate border-spacing-6">
                        <thead>
                            <x-table-row>
                                <th>Name</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </x-table-row>
                        </thead>
                        <tbody>
                            @forelse ($businessCategories as $businessCategory)
                                <x-table-row>
                                    <td class="font-bold">{{ $businessCategory->category_name }}</td>
                                    <td>{{ $businessCategory->created_at }}</td>
                                    <td>{{ $businessCategory->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('businessCategory.edit', $businessCategory->id) }}"
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
                                    <td>{{ __('No business categories found') }}</td>
                                </x-table-row>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $businessCategories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
