<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in! These are statistics of your activity.") }}

                    <div class="relative overflow-x-auto mt-6">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50">  {{--dark:bg-gray-700 dark:text-gray-400--}}
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Item
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Count
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b ">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                                        Total People
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $peopleCount }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b ">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                                        Total Businesses
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $businessCount }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b ">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                                        Total Tasks
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $taskCount }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b ">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                                        Total Categories
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $categoryCount }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b ">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                                        Total Notes
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $noteCount }}
                                    </td>
                                </tr>

                                @php
                                    $timePeriods = ['Day', 'Week', 'Month', 'Year'];
                                    $categories = ['Persons', 'Businesses', 'Notes', 'Tasks', 'Categories'];
                                @endphp

                                @foreach ($timePeriods as $timePeriod)
                                    {{-- Statistics By {{ $timePeriod }} --}}
                                    <tr class="px-6 py-4 text-xs text-gray-700 uppercase bg-gray-50 whitespace-no-wrap text-center">
                                        <td colspan="2" class="px-6 py-4">Statistics By {{ $timePeriod }}</td>
                                    </tr>

                                    @foreach ($categories as $category)
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-no-wrap">
                                                Added {{ $category }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ ${'statisticsBy'.$timePeriod}['created'.$category] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
