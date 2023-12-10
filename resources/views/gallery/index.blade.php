<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-section-header>
                {{ __('Gallery') }}
            </x-section-header>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-700 dark:text-white">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 items-center justify-center">

                    @forelse ($notesWithImages as $note)
                        <div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-12">
                            <div class="-m-1 flex flex-wrap md:-m-2">
                                <div class="flex w-1/3 flex-wrap">
                                    <div class="w-full p-4 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center hover:scale-125 transition ease-in duration-500"
                                            src="{{ Storage::url($note->image) }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="m-6 p-6">{{ __('No images found') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
