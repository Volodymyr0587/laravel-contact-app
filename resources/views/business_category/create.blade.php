<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Business Categories') }}
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">

                    <h3 class="font-semibold pb-5">{{ __("Add a new business category") }}</h3>

                    <form action="{{ route('businessCategory.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="category_name">{{ __("Business category name") }}</label>
                                <x-form-input type="text" name="category_name" id="category_name"
                                    value="{{ old('category_name') }}"></x-form-input>

                                @error('category_name')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </span>

                        </div>


                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <x-action-button>
                                <a href="{{ route('businessCategory.index') }}">{{ __("Cancel") }}</a>
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
