@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}>
