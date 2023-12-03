<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Business Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="font-semibold pb-5">Edit business category: {{ $businessCategory->cateory_name }}</h3>

                    <form action="{{ route('businessCategory.update', $businessCategory->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                            <span class="sm:col-span-3">
                                <label class="block" for="category_name">Business category name</label>
                                <input class="block w-full" type="text" name="category_name" id="category_name"
                                    value="{{ old('category_name', $businessCategory->category_name) }}">
                            </span>

                        </div>



                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600" href="{{ route('businessCategory.index') }}">
                                Cancel
                            </a>
                            <button class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600" type="submit">
                                Save
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('businessCategory.destroy', $businessCategory->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')

                        <div class="border bg-red-600 text-white mt-6 p-6">
                            <h3 class="font-semibold">Danger zone</h3>
                            <p>You can delete this business category here</p>
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
