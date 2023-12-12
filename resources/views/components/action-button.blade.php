<button {{ $attributes->merge(['type' => 'submit','class' => 'inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent font-semibold text-sm rounded-md text-white uppercase tracking-widest hover:bg-yellow-200 hover:text-blue-600 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
