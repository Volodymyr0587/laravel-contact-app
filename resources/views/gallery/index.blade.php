<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-section-header>
                {{ __('Gallery') }}
            </x-section-header>

        </div>
    </x-slot>

    <div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-12">

        <p class="m-4 p-4 font-bold dark:text-white">{{ __('Notes') }}</p>

        <div class="-m-1 flex flex-wrap md:-m-2">
            @forelse ($notesWithImages as $index => $note)
                <div class="flex w-1/3 flex-wrap">
                    <div class="w-full p-1 md:p-2">
                        <img id="myImg{{ $index }}" alt="{{ generate_image_name_from_image_path($note->image) }}"
                            class="modal-image cursor-zoom-in block h-full w-full rounded-lg object-cover object-center transition duration-300 ease-in-out hover:scale-110"
                            src="{{ Storage::url($note->image) }}" />
                    </div>
                </div>
            @empty
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 items-center justify-center">
                    <p class="m-6 p-6 dark:text-white">{{ __('No images found') }}</p>
                </div>
            @endforelse
        </div>

        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

        <p class="m-4 p-4 font-bold dark:text-white">{{ __('People') }}</p>

        <div class="-m-1 flex flex-wrap md:-m-2">
            @forelse ($peopleWithImages as $index => $person)
                <div class="flex w-1/3 flex-wrap">
                    <div class="w-full p-1 md:p-2">
                        <img id="myImg{{ $index }}" alt="{{ generate_image_name_from_image_path($person->image) }}"
                            class="modal-image cursor-zoom-in block h-full w-full rounded-lg object-cover object-center transition duration-300 ease-in-out hover:scale-110"
                            src="{{ is_url($person->image) ? $person->image : Storage::url($person->image) }}" />
                    </div>
                </div>
            @empty
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 items-center justify-center">
                    <p class="m-6 p-6 dark:text-white">{{ __('No images found') }}</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- The Modal --}}
    <div id="myModal" class="modal">

        {{-- The Close Button --}}
        <span class="close">&times;</span>

        {{-- Modal Content (The Image) --}}
        <img class="modal-content" id="img01">

        {{-- Modal Caption (Image Text) --}}
        <div id="caption"></div>
    </div>

</x-app-layout>
