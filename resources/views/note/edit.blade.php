<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Edit Note') }}
        </x-section-header>
    </x-slot>

    <div class="py-12 c">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">

                    <h3 class="font-semibold pb-5">{{ __("Edit Note") }}: {{ $note->title }}</h3>

                    <form action="{{ route('note.update', $note->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="title">{{ __("Title") }}</label>
                                <x-form-input type="text" name="title" id="title"
                                    value="{{ old('title', $note->title) }}"></x-form-input>
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="image">{{ __("Image") }}</label>
                                <input class="block w-full" type="file" name="image" id="image"
                                    value="{{ old('image') }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="body">{{ __("Content") }}</label>
                                    <textarea rows="4"
                                            class="block p-2.5 w-full text-left text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Write your thoughts here..."
                                            type="text"
                                            name="body"
                                            id="body">{{ old('body', strip_tags($note->body)) }}
                                    </textarea>

                                <div class="flex mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                    </svg>
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" id="is_active" name="is_active" class="w-6 h-6 mr-2"
                                    value="1" {{ $note->is_active || old('is_active', 0) === 1 ? 'checked' : '' }} >
                                    <label for="is_active">{{ __("Staple to the top") }}</label>
                                </div>

                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="tags">{{ __("Keywords [separated by a space]") }}</label>
                                <input class="block p-2.5 w-full text-left text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="tags" name="tags" value="{{ implode(" ", $note->tags->pluck('tag_name')->toArray()) }}">
                            </span>

                        </div>

                        {{-- <h4 class="font-semibold pt-5">Keywords</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-x-6 gap-y-6">
                            <span class="sm:col-span-2">
                                <input type="text" id="tags" name="tags" value="{{ implode(" ", $note->tags->pluck('tag_name')->toArray()) }}">
                            </span>
                        </div> --}}

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <x-action-button>
                                <a href="{{ route('note.show', $note->id) }}">
                                    {{ __("Cancel") }}
                                </a>
                            </x-action-button>
                            <x-action-button type="submit">
                                {{ __("Save") }}
                            </x-action-button>
                        </div>
                    </form>

                    <form action="{{ route('note.destroy', $note->id) }}" method="POST"
                        onsubmit="return confirm('{{ __('Are you sure?') }}');">
                        @csrf
                        @method('DELETE')

                        <div class="border rounded-lg bg-red-600 text-white mt-6 p-6">
                            <h3 class="font-semibold">{{ __("Danger zone") }}</h3>
                            <p>{{ __("You can delete this note here") }}</p>
                            <x-action-button type="submit">
                                {{ __("Delete") }}
                            </x-action-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
