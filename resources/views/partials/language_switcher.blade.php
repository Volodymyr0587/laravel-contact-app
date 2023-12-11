<div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
            <span class="bg-yellow-300 p-1 rounded-full ml-2 mr-2 text-gray-700 dark:text-gray-600">{{ $locale_name }}</span>
        @else
            <a class="underline ml-2 mr-2 p-1 text-gray-700 dark:text-white" href="language/{{ $available_locale }}">
                <span>{{ $locale_name }}</span>
            </a>
        @endif
    @endforeach
</div>
