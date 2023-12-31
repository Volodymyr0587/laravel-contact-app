<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Tags') }}
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">

                    <h3 class="font-semibold pb-5">{{ __("Add a new tag") }}</h3>

                    <form action="{{ route('tag.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="tag_name">{{ __("Tag name") }}</label>
                                <x-form-input type="text" name="tag_name" id="tag_name"
                                    value="{{ old('tag_name') }}"></x-form-input>

                                <label class="block mt-4 mb-2" for="color">{{ __("Tag Color") }}</label>
                                <span class="sm:col-span-3">
                                    <input id="nativeColorPicker1" name="color" type="color" value="#6590D5"
                                    class="p-1 cursor-pointer" />
                                    <span
                                      id="burronNativeColor"
                                      class="inline-block rounded-full bg-green-500 px-6 py-2.5 text-xs font-medium
                                      uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out">
                                      {{ __("Tag Color") }}
                                    </span>
                                </span>

                                @error('tag_name')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </span>

                        </div>


                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <x-action-button>
                                <a href="{{ route('tag.index') }}">{{ __("Cancel") }}</a>
                            </x-action-button>
                            <x-action-button type="submit">
                                {{ __("Save") }}
                            </x-action-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
