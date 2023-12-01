<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Person') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="font-semibold pb-5">Edit a person: {{ $person->firstname }} {{ $person->lastname }}</h3>

                    <form action="{{ route('person.update', $person->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="firstname">First name</label>
                                <input class="block w-full" type="text" name="firstname" id="firstname"
                                    value="{{ old('firstname', $person->firstname) }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="lastname">Last name</label>
                                <input class="block w-full" type="text" name="lastname" id="lastname"
                                    value="{{ old('lastname', $person->lastname) }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="email">Email</label>
                                <input class="block w-full" type="text" name="email" id="email"
                                    value="{{ old('email', $person->email) }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="phone">Phone</label>
                                <input class="block w-full" type="text" name="phone" id="phone"
                                    value="{{ old('phone', $person->phone) }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="birthday">Date of birth</label>
                                <input class="block w-full" type="date" name="birthday" id="birthday"
                                    value="{{ old('birthday', $person?->birthday) }}">

                                @error('birthday')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="image">Image</label>
                                <input class="block w-full" type="file" name="image" id="image"
                                    value="{{ old('image') }}">
                            </span>
                            <span class="sm:col-span-3">
                                <label class="block" for="business">Business</label>
                                <select class="block w-full" name="business_id" id="business_id">
                                    <option value=""  @selected("" == old('business_id', $person->business_id))>( No Business )</option>
                                    @foreach ($businesses as $business)
                                        <option value="{{ $business->id }}" @selected($business->id == old('business_id', $person->business_id))>
                                            {{ $business->business_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </span>
                        </div>

                        <h4 class="font-semibold pt-5">Tags</h4>
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
                                Cancel
                            </a>
                            <button class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600" type="submit">
                                Save
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('person.destroy', $person->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')

                        <div class="border bg-red-600 text-white mt-6 p-6">
                            <h3 class="font-semibold">Danger zone</h3>
                            <p>You can delete this person here</p>
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
