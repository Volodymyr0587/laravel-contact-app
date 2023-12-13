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
            <div class="flex w-1/3 flex-wrap">
                <p class="m-4 p-4 font-bold dark:text-white">{{ __('Notes') }}</p>
                <div class="w-full p-1 md:p-2">
                    <a href="{{ route('gallery.notesImages') }}">
                        <img alt=""
                            class="cursor-pointer block h-full w-full rounded-lg object-cover object-center transition duration-300 ease-in-out hover:scale-110"
                            src="{{ asset('images/note-no-image.png') }}" />
                    </a>
                </div>
            </div>

            <div class="flex w-1/3 flex-wrap">
                <p class="m-4 p-4 font-bold dark:text-white">{{ __('People') }}</p>
                <div class="w-full p-1 md:p-2">

                    <a href="{{ route('gallery.peopleImages') }}">
                    <img alt=""
                        class="cursor-pointer block h-full w-full rounded-lg object-cover object-center transition duration-300 ease-in-out hover:scale-110"
                        src="{{ asset('images/person-no-image.png') }}" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
