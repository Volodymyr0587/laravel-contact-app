<x-app-layout>
    <x-slot name="header">
        <x-section-header class="inline-flex">
            <a class="flex justify-left items-center mr-2" href="{{ URL::previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </a>
            {{ __('Note') }} | {{ $note->title }}
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700"">
                <div class="p-6 text-gray-900 dark:text-white">
                    <div class="flex">
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">{{ $note->title }}</h3>
                            <div
                                class="pl-3 pb-8 first-letter:text-7xl first-letter:font-bold
                            first-letter:mr-3 first-letter:float-left">
                                <img class="object-contain mr-8 pt-2 mb-4 h-48 w-96 float-left"
                                    src="{{ $note->image ? Storage::url($note->image) : asset('/images/note-no-image.png') }}"
                                    alt="Photo">
                                {!! $note->body !!}
                            </div>

                                <dl class="mt-8">
                                    <dd>
                                        <span class="font-bold">{{ __("Keywords") }}:</span>
                                        @foreach ($note->tags as $tag)
                                            <span class="bg-green-600 text-white text-xs px-1 rounded-full">
                                                <a href="{{ route('note.getByTag', $tag->tag_name) }}">
                                                    {{ $tag->tag_name }}
                                                </a>
                                            </span>
                                        @endforeach
                                    </dd>
                                    <dd>
                                        <span class="font-bold">{{ __("Related notes") }}:</span>
                                        @if ($relatedNotes->isNotEmpty())
                                            @foreach ($relatedNotes as $relatedNote)
                                                <span class="bg-green-600 text-white text-sm px-2 py-1 rounded-full">
                                                    <a href="{{ route('note.show', $relatedNote->id) }}">
                                                        {{ $relatedNote->title }}
                                                    </a>
                                                </span>
                                            @endforeach
                                        @else
                                            <i> {{ __("No related notes") }} </i>
                                        @endif

                                    </dd>
                                </dl>


                            <div class="pt-3">
                                <x-action-button>
                                    <a href="{{ route('note.edit', $note->id) }}">
                                        {{ __("Edit Note") }}
                                    </a>
                                </x-action-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
