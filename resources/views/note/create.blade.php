<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="font-semibold pb-5">Add a new note</h3>

                    <form action="{{ route('note.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="title">Title</label>
                                <input class="block w-full" type="text" name="title" id="title"
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
                                <textarea class="block w-full" type="text" name="body" id="body">{{ old('body') }}</textarea>

                                @error('body')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="mt-4">
                                    <input type="checkbox" id="is_active" name="is_active" value="1">
                                    <label for="is_active">Is Active</label>
                                </div>
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="tags">Keywords [separated by a space]</label>
                                <input class="block w-full" type="text" id="tags" name="tags" value="{{ old('tags') }}">
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
