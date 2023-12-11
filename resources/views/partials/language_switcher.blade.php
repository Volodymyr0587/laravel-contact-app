<div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
            <span class="bg-yellow-300 p-1 rounded-full ml-2 mr-2 text-gray-700 dark:text-gray-600">{{ $locale_name }}</span>
        @else
            {{-- <a class="underline ml-2 mr-2 p-1 text-gray-700 dark:text-white" href="language/{{ $available_locale }}">
                <span>{{ $locale_name }}</span>
            </a> --}}
            <a class="underline ml-2 mr-2 p-1 text-gray-700 dark:text-white" href="{{ url('language/' . $available_locale . '?' . http_build_query(request()->except('language'))) }}">
                <span>{{ $locale_name }}</span>
            </a>
        @endif
    @endforeach
</div>

{{-- http_build_query(request()->except('language')) is used to get all
the current query parameters except the 'language' parameter. This way,
when you switch the language, the other query parameters
(like the note_id in your case) will be preserved. --}}
