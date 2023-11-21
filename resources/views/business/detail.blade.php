<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business') }} | {{ $business->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-6">
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">Business Details</h3>
                            <dl>
                                <dt class="font-semibold">Business Name</dt>
                                <dd class="pl-3">{{ $business->name }}</dd>
                                <dt class="font-semibold">Email</dt>
                                <dd class="pl-3">{{ $business->contact_email }}</dd>
                            </dl>

                            <div class="pt-3">
                                <a href="" class="bg-blue-600 text-white py-2 px-3 rounded-full"></a>
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <h3 class="font-semibold text-l pb-5">Tasks</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
