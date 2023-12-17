<div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
            @if ($available_locale == 'ua')
                <span class="bg-gradient-to-b from-blue-700 to-yellow-400 p-1 rounded-md ml-1 text-white">{{ $locale_name }}</span>
            @elseif ($available_locale == 'en')
                <span class="bg-gradient-to-br from-blue-500  to-red-400 p-1 rounded-md ml-1 text-white">{{ $locale_name }}</span>
            @endif
        @else
            <a class="underline ml-1  p-1 text-gray-700 dark:text-white" href="{{ url('language/' . $available_locale . '?' . http_build_query(request()->except('language'))) }}">
                <span>{{ $locale_name }}</span>
            </a>
        @endif
    @endforeach
</div>

{{-- http_build_query(request()->except('language')) is used to get all
the current query parameters except the 'language' parameter. This way,
when you switch the language, the other query parameters
(like the note_id in your case) will be preserved. --}}
