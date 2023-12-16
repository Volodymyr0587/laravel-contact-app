<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex dark:text-white">
            <a class="flex justify-left items-center mr-2" href="{{ URL::previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </a>
            {{ __('Person') }} | {{ $person->firstname }} {{ $person->lastname }}
        </h2>
    </x-slot>

    <div class="py-12 dark:text-gray-600">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">
                    <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">{{ __("Person Details") }}</h3>
                            <dl>
                                <dd class="pl-3">
                                    <div class="person-image-container">
                                        @if (!empty($person->image))
                                            <img class="person-image object-contain object-left h-48 w-96"
                                            src="{{ is_url($person->image) ? $person->image : Storage::url($person->image) }}"
                                            alt="Photo">
                                        @else
                                             {{-- Use default image --}}
                                             <img class="person-image object-contain object-left h-48 w-96"
                                             src="{{ asset('images/person-no-image.png') }}" alt="Default photo">
                                        @endif
                                        <div class="person-image-overlay">{{ $person->firstname }} {{ $person->lastname }}</div>
                                    </div>
                                </dd>
                                <dt class="font-semibold">{{ __("Name") }}</dt>
                                <dd class="pl-3">{{ $person->firstname }} {{ $person->lastname }}</dd>
                                <dt class="font-semibold">{{ __("Phone") }}</dt>
                                <dd class="pl-3">{{ $person->phone }}</dd>
                                <dt class="font-semibold">{{ __("Email") }}</dt>
                                <dd class="pl-3">{{ $person->email }}</dd>
                                <dt class="font-semibold">{{ __("Birthday") }}</dt>
                                <dd class="pl-3">{{ $person->birthday ?: 'No date' }}</dd>
                                <dt class="font-semibold">{{ __("Categories") }}</dt>
                                <dd class="pl-3">
                                    @foreach ($person->tags as $tag)
                                        <span class="bg-green-600 text-white text-xs px-1 rounded-full">{{ $tag->tag_name }}</span>
                                    @endforeach
                                </dd>
                            </dl>

                            <div class="pt-3">
                                <div class="mb-2">
                                    @if ($person->is_favorite)
                                        <form action="{{ route('person.markAsNormal', $person->id) }}" method="POST">
                                            @csrf
                                            <x-action-button class="bg-red-400">
                                            {{ __("Remove from Favorite") }}
                                        </x-action-button>
                                        </form>
                                    @else
                                        <form action="{{ route('person.markAsFavorite', $person->id) }}" method="POST">
                                            @csrf
                                            <x-action-button>
                                            {{ __("Add to Favorite") }}
                                        </x-action-button>
                                        </form>
                                    @endif
                                </div>
                                <x-action-button>
                                    <a href="{{ route('person.edit', $person->id) }}">
                                        {{ __("Edit Person") }}
                                    </a>
                                </x-action-button>
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">{{ __("Creat new task") }}</h3>
                            <form action="{{ route('task.store') }}" method="POST">
                                @csrf

                                <input type="hidden" name="taskable_id" value="{{$person->id}}">
                                <input type="hidden" name="target_model" value="person">
                                <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                                    <span class="sm:col-span-6">
                                        <label class="block" for="title">{{ __("Task title") }}</label>
                                        <x-form-input type="text" name="title" id="title" value="{{ old('title') }}"></x-form-input>

                                        @error('title')
                                            <div class="text-red-500 mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </span>
                                    <span class="sm:col-span-6">
                                        <label class="block" for="description">{{ __("Task description") }}</label>
                                        <textarea class="block p-2.5 w-full text-left text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        type="text" name="description" id="description">{{ old('description') }}</textarea>

                                        @error('description')
                                            <div class="text-red-500 mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="mt-5 flex items-center justify-end gap-x-6">
                                    <x-action-button type="submit">{{ __("Create Task") }}</x-action-button>
                                </div>
                            </form>

                            <h3 class="font-semibold text-l pb-5">{{ __("Tasks") }}</h3>
                            @foreach ($person->tasks->sortByDesc('created_at') as $task)
                                <div class="border-t border-grey-500 py-3">
                                    <h4 class="font-semibold">{{$task->title}}</h4>
                                    <p>{{$task->description}}</p>
                                    @if ($task->status == "open")
                                        <div class="pt-3">
                                            <form action="{{route('task.complete', $task->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <x-action-button type="submit">
                                                    {{ __("Complete Task") }}
                                                </x-action-button>
                                            </form>
                                        </div>
                                    @else
                                        <p class="italic">{{ __("Completed") }}</p>
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
