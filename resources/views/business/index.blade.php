<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Businesses') }}
            </h2>
            <form action="{{ route('business.search') }}" method="GET">
                <input class="rounded-md" type="text" name="search" required />
                <button class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                    type="submit">Search</button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-end">
                        <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                            href="{{ route('business.create') }}">Add Business</a>
                    </div>

                    <table class="table-fixed border-separate border-spacing-6">
                        <thead>
                            <tr>
                                <th>Business Name</th>
                                <th>Contact Email</th>
                                <th>Categories</th>
                                <th>Tags</th>
                                <th>#people</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($businesses as $business)
                                <tr>
                                    <td><a href="{{ route('business.show', $business->id) }}"
                                            class="text-blue-700 font-bold hover:bg-yellow-300 py-2 px-2 rounded-full">
                                            {{ $business->business_name }}</a></td>
                                    <td>{{ $business->contact_email }}</td>
                                    <td>
                                        @foreach ($business->categories as $category)
                                            <span class="bg-orange-500 py-1 px-1 rounded-full">
                                                <a href="{{ route('business.getByCategory', $category->category_name) }}">{{ $category->category_name }}</a>
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($business->tags as $tag)
                                            <span class="bg-green-500 py-1 px-1 rounded-full">
                                                <a
                                                    href="{{ route('business.getByTag', $tag->tag_name) }}">{{ $tag->tag_name }}</a>
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $business->people_count }}
                                    </td>
                                    <td>
                                        <a href="{{ route('business.edit', $business->id) }}"
                                            class="flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
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
                    {{ $businesses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
