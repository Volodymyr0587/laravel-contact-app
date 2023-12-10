<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-section-header>
                {{ __('Gallery') }}
            </x-section-header>

        </div>
    </x-slot>

    <div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-12">
        <div class="-m-1 flex flex-wrap md:-m-2">
            @forelse ($notesWithImages as $note)
                <div class="flex w-1/3 flex-wrap">
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center transition duration-300 ease-in-out hover:scale-110"
                            src="{{ Storage::url($note->image) }}" />
                    </div>
                </div>
            @empty
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 items-center justify-center">
                    <p class="m-6 p-6">{{ __('No images found') }}</p>
                </div>
            @endforelse
        </div>
    </div>

</x-app-layout>
