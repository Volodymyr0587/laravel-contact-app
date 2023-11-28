<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex">
            <a class="flex justify-left items-center mr-2" href="{{ URL::previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </a>
            {{ __('Note') }} | {{ $note->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">{{ $note->title }}</h3>
                            <div class="pl-3">
                                <img class="object-contain object-left h-48 w-96" src="{{ $note->image ? Storage::url($note->image) : asset('/images/note-no-image.png') }}" alt="Photo">
                            </div>
                            <div>
                                {{ $note->body }}
                            </div>
                            <dl>
                                <dd>
                                    @foreach ($note->tags as $tag)
                                        <span class="bg-green-600 text-white text-xs px-1 rounded-full">{{ $tag->tag_name }}</span>
                                    @endforeach
                                </dd>
                            </dl>

                            <div class="pt-3">
                                <a href="{{ route('note.edit', $note->id) }}" class="bg-blue-600 text-white py-2 px-3 rounded-full hover:bg-yellow-300 hover:text-blue-600">Edit Note</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
