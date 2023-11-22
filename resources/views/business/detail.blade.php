<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business') }} | {{ $business->business_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">Company Details</h3>
                            <dl>
                                <dt class="font-semibold">Name</dt>
                                <dd class="pl-3">{{ $business->business_name }}</dd>
                                <dt class="font-semibold">Contact Email</dt>
                                <dd class="pl-3">{{ $business->contact_email }}</dd>
                            </dl>

                            <div class="pt-3">
                                <a href="{{ route('business.edit', $business->id) }}" class="bg-blue-600 text-white py-2 px-3 rounded-full">Edit Business</a>
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">Creat new task</h3>
                            <form action="" method="POST">
                                @csrf

                                <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                                    <span class="sm:col-span-3">
                                        <label class="block" for="title">Task title</label>
                                        <input class="block w-full" type="text" name="title" id="title"
                                            value="{{ old('title') }}">

                                        @error('title')
                                            <div class="text-red-500 mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </span>
                                    <span class="sm:col-span-3">
                                        <label class="block" for="description">Task description</label>
                                        <input class="block w-full" type="text" name="description" id="description"
                                            value="{{ old('description') }}">

                                        @error('description')
                                            <div class="text-red-500 mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="mt-6 flex items-center justify-end gap-x-6">

                                    <button
                                        class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                                        type="submit">
                                        Create Task
                                    </button>
                                </div>
                            </form>

                            <h3 class="font-semibold text-l pb-5">Tasks</h3>
                            @foreach ($business->tasks as $task)
                                <h4 class="font-semibold">{{ $task->title }}</h4>
                                <p>{{ $task->description }}</p>
                                <p>Status: {{ $task->status }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
