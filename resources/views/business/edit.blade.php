<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Edit Business') }}
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">

                    <h3 class="font-semibold pb-5">{{ __("Edit business") }}: {{ $business->business_name }}</h3>

                    <form action="{{ route('business.update', $business->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="business_name">{{ __("Business name") }}</label>
                                <x-form-input type="text" name="business_name" id="business_name"
                                    value="{{ old('business_name', $business->business_name) }}"></x-form-input>

                                @error('business_name')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </span>

                            <span class="sm:col-span-3">
                                <label class="block" for="contact_email">{{ __("Email") }}</label>
                                <x-form-input type="text" name="contact_email" id="contact_email"
                                    value="{{ old('contact_email', $business->contact_email) }}"></x-form-input>

                                @error('contact_email')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </span>

                            <span class="sm:col-span-3">
                                <label class="block" for="category">{{ __("Category") }}</label>
                                <select class="block p-2.5 w-full text-left text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="category_id" id="category_id">
                                    <option value="" @selected("" == old('category_id', $business->category_id))>( {{ __("No Category") }} )</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($category->id == old('category_id', $business->category_id))>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </span>

                        </div>

                        <h4 class="font-semibold pt-5">{{ __("Tags") }}</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-x-6 gap-y-6">
                            @foreach ($tags as $tag)
                                <span class="sm:col-span-2">
                                    <input type="checkbox" id="tag{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->tag_name, $business->tags->pluck('tag_name')->toArray())) >
                                    <label for="tag{{ $tag->id }}">{{ $tag->tag_name }}</label>
                                </span>
                            @endforeach
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                                href="{{ route('business.index') }}">{{ __("Cancel") }}</a>
                            <button
                                class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                                type="submit">
                                {{ __("Save") }}
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('business.destroy', $business->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')

                        <div class="border rounded-lg bg-red-600 text-white mt-6 p-6">
                            <h3 class="font-semibold">{{ __("Danger zone") }}</h3>
                            <p>{{ __("You can delete this business here") }}</p>
                            <button
                                class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                                type="submit">
                                {{ __("Delete") }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
