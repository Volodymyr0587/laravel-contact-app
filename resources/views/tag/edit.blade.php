<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Edit Tag') }}
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">

                    <h3 class="font-semibold pb-5">{{ __('Edit Tag') }}: {{ $tag->tag_name }}</h3>

                    <form action="{{ route('tag.update', $tag->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="tag_name">{{ __('Tag name') }}</label>
                                <x-form-input type="text" name="tag_name" id="tag_name"
                                    value="{{ old('tag_name', $tag->tag_name) }}"></x-form-input>
                                @error('tag_name')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </span>

                        </div>



                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <x-action-button>
                                <a href="{{ route('tag.index') }}">{{ __('Cancel') }}</a>
                            </x-action-button>
                            <x-action-button type="submit">
                                {{ __('Save') }}
                            </x-action-button>
                        </div>
                    </form>

                    <form action="{{ route('tag.destroy', $tag->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')

                        <div class="border rounded-lg bg-red-600 text-white mt-6 p-6">
                            <h3 class="font-semibold">{{ __('Danger zone') }}</h3>
                            <p>{{ __('You can delete this tag here') }}</p>
                            <x-action-button type="submit">
                                {{ __('Delete') }}
                            </x-action-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
