<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="font-semibold pb-5">Edit a note: {{ $note->title }}</h3>

                    <form action="{{ route('note.update', $note->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="title">Title</label>
                                <input class="block w-full" type="text" name="title" id="title"
                                    value="{{ old('title', $note->title) }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="image">Image</label>
                                <input class="block w-full" type="file" name="image" id="image"
                                    value="{{ old('image') }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="body">Content</label>
                                <input class="block w-full" type="text" name="body" id="body"
                                    value="{{ old('body', $note->body) }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="tags">Keywords [separated by a space]</label>
                                <input class="block w-full" type="text" id="tags" name="tags" value="{{ implode(" ", $note->tags->pluck('tag_name')->toArray()) }}">
                            </span>

                        </div>

                        {{-- <h4 class="font-semibold pt-5">Keywords</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-x-6 gap-y-6">
                            <span class="sm:col-span-2">
                                <input type="text" id="tags" name="tags" value="{{ implode(" ", $note->tags->pluck('tag_name')->toArray()) }}">
                            </span>
                        </div> --}}

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600" href="{{ route('note.show', $note->id) }}">
                                Cancel
                            </a>
                            <button class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600" type="submit">
                                Save
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('note.destroy', $note->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')

                        <div class="border bg-red-600 text-white mt-6 p-6">
                            <h3 class="font-semibold">Danger zone</h3>
                            <p>You can delete this note here</p>
                            <button class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600" type="submit">
                                Delete
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
