<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex dark:text-white">
            <a class="flex justify-left items-center mr-2" href="{{ URL::previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </a>
            {{ __('Businesses') }} | {{ $business->business_name }}
        </h2>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">
                    <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">Company Details</h3>
                            <dl>
                                <dt class="font-semibold">Name</dt>
                                <dd class="pl-3">{{ $business->business_name }}</dd>
                                <dt class="font-semibold">Contact email</dt>
                                <dd class="pl-3">{{ $business->contact_email }}</dd>
                                <dt class="font-semibold">Tags</dt>
                                <dd class="pl-3">
                                    @foreach ($business->tags as $tag)
                                        <span
                                            class="bg-green-600 text-white text-xs px-1 rounded-full">{{ $tag->tag_name }}</span>
                                    @endforeach
                                </dd>
                            </dl>

                            <div class="pt-3">
                                <a class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                                    href="{{ route('business.edit', $business->id) }}">Edit Business</a>
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">Create a new Task</h3>
                            <form action="{{ route('task.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="taskable_id" value="{{ $business->id }}">
                                <input type="hidden" name="target_model" value="business">
                                <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                                    <span class="sm:col-span-6">
                                        <label class="block" for="title">Task title </label>
                                        <input class="block w-full dark:text-gray-600" type="text" name="title" id="title"
                                            value="{{ old('title') }}">

                                        @error('title')
                                            <div class="text-red-500 mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </span>
                                    <span class="sm:col-span-6">
                                        <label class="block" for="description">Task description</label>
                                        <textarea class="block w-full dark:text-gray-600" type="text" name="description" id="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="text-red-500 mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="mt-5 flex items-center justify-end gap-x-6">
                                    <button type="submit"
                                        class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600">Create
                                        Task</button>
                                </div>
                            </form>

                            <h3 class="font-semibold text-l pb-5">Tasks</h3>
                            @foreach ($business->tasks->sortByDesc('created_at') as $task)
                                <div class="border-t border-grey-500 py-3">
                                    <h4 class="font-semibold">{{ $task->title }}</h4>
                                    <p>{{ $task->description }}</p>
                                    @if ($task->status == 'open')
                                        <div class="pt-3">
                                            <form action="{{ route('task.complete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button
                                                    class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600"
                                                    type="submit">Complete Task</button>
                                            </form>
                                        </div>
                                    @else
                                        <p class="italic">Completed</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
