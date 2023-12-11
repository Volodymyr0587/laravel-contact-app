<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Edit Person') }}
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">

                    <h3 class="font-semibold pb-5">{{ __("Edit Person") }}: {{ $person->firstname }} {{ $person->lastname }}</h3>

                    <form action="{{ route('person.update', $person->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="firstname">{{ __("First name") }}</label>
                                <x-form-input type="text" name="firstname" id="firstname"
                                    value="{{ old('firstname', $person->firstname) }}"></x-form-input>
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="lastname">{{ __("Last name") }}</label>
                                <x-form-input type="text" name="lastname" id="lastname"
                                    value="{{ old('lastname', $person->lastname) }}"></x-form-input>
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="email">{{ __("Email") }}</label>
                                <x-form-input type="text" name="email" id="email"
                                    value="{{ old('email', $person->email) }}"></x-form-input>
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="phone">{{ __("Phone") }}</label>
                                <x-form-input type="text" name="phone" id="phone"
                                    value="{{ old('phone', $person->phone) }}"></x-form-input>
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="birthday">{{ __("Date of birth") }}</label>
                                <x-form-input type="date" name="birthday" id="birthday"
                                    value="{{ old('birthday', $person?->birthday) }}"></x-form-input>

                                @error('birthday')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="image">{{ __("Image") }}</label>
                                <input class="block w-full" type="file" name="image" id="image"
                                    value="{{ old('image') }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="business">{{ __("Business") }}</label>
                                <select class="block p-2.5 w-full text-left text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="business_id" id="business_id">
                                    <option value=""  @selected("" == old('business_id', $person->business_id))>( {{ __("No Business") }} )</option>
                                    @foreach ($businesses as $business)
                                        <option value="{{ $business->id }}" @selected($business->id == old('business_id', $person->business_id))>
                                            {{ $business->business_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </span>
                        </div>

                        <h4 class="font-semibold pt-5">{{ __("Categories") }}</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-x-6 gap-y-6">
                            @foreach ($tags as $tag)
                                <span class="sm:col-span-2">
                                    <input type="checkbox" id="tag{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->tag_name, $person->tags->pluck('tag_name')->toArray())) >
                                    <label for="tag{{ $tag->id }}">{{ $tag->tag_name }}</label>
                                </span>
                            @endforeach
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600" href="{{ route('person.index') }}">
                                {{ __("Cancel") }}
                            </a>
                            <button class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600" type="submit">
                                {{ __("Save") }}
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('person.destroy', $person->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')

                        <div class="border rounded-lg bg-red-600 text-white mt-6 p-6">
                            <h3 class="font-semibold">{{ __("Danger zone") }}</h3>
                            <p>{{ __("You can delete this person here") }}</p>
                            <button class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600" type="submit">
                                {{ __("Delete") }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
