<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Notes') }}
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">

                    <h3 class="font-semibold pb-5">Add a new note</h3>

                    <form action="{{ route('note.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="title">Title</label>
                                <input class="block w-full dark:text-gray-600" type="text" name="title" id="title"
                                    value="{{ old('title') }}">

                                @error('title')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="image">Image</label>
                                <input class="block w-full" type="file" name="image" id="image"
                                    value="{{ old('image') }}">

                                @error('image')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="body">Content</label>
                                <textarea class="block w-full dark:text-gray-600" type="text" name="body" id="body">{{ old('body') }}</textarea>

                                @error('body')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="flex mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                    </svg>
                                    <input type="checkbox" id="is_active" name="is_active" value="1" class="w-6 h-6 mr-2">
                                    <label for="is_active">Staple to the top</label>
                                </div>
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="tags">Keywords [separated by a space]</label>
                                <input class="block w-full dark:text-gray-600" type="text" id="tags" name="tags" value="{{ old('tags') }}">
                            </span>
                        </div>

                        {{-- <h4 class="pt-5">Keywords [separated by a space]</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-x-6 gap-y-6">
                            @foreach ($note_tags as $tag)
                                <span class="sm:col-span-2">
                                    <input type="checkbox" id="tag{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}">
                                    <label for="tag{{ $tag->id }}">{{ $tag->tag_name }}</label>
                                </span>
                            @endforeach
                            {<span class="sm:col-span-2">
                                <input type="text" id="tags" name="tags">
                            </span>
                        </div>--}}

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                                href="{{ route('note.index') }}">Cancel</a>
                            <button
                                class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                                type="submit">
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
