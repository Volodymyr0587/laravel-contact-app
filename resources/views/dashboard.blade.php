<x-app-layout>
    <x-slot name="header">
        <x-section-header>
            {{ __('Dashboard') }}
        </x-section-header>
    </x-slot>

    <div class="py-12 dark:bg-gray-900">
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
                                        {{ __("ITEM") }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __("COUNT") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <x-table-row>
                                    <x-table-header>
                                        {{ __("Total People") }}
                                    </x-table-header>
                                    <td class="px-6 py-4">
                                        {{ $peopleCount }}
                                    </td>
                                </x-table-row>
                                <x-table-row>
                                    <x-table-header>
                                        {{ __("Total Businesses") }}
                                    </x-table-header>
                                    <td class="px-6 py-4">
                                        {{ $businessCount }}
                                    </td>
                                </x-table-row>
                                <x-table-row>
                                    <x-table-header>
                                        {{ __("Total Business Categories") }}
                                    </x-table-header>
                                    <td class="px-6 py-4">
                                        {{ $businessCategoriesCount }}
                                    </td>
                                </x-table-row>
                                <x-table-row>
                                    <x-table-header>
                                        {{ __("Total Notes") }}
                                    </x-table-header>
                                    <td class="px-6 py-4">
                                        {{ $noteCount }}
                                    </td>
                                </x-table-row>
                                <x-table-row>
                                    <x-table-header>
                                        {{ __("Total Tasks") }}
                                    </x-table-header>
                                    <td class="px-6 py-4">
                                        {{ $taskCount }}
                                    </td>
                                </x-table-row>
                                <x-table-row>
                                    <x-table-header>
                                        {{ __("Total Tags") }}
                                    </x-table-header>
                                    <td class="px-6 py-4">
                                        {{ $categoryCount }}
                                    </td>
                                </x-table-row>


                                @php
                                    $timePeriods = ['Day', 'Week', 'Month', 'Year'];
                                    $categories = ['Persons', 'Businesses', 'BusinessCategories', 'Notes', 'Tasks', 'Categories'];
                                @endphp

                                @foreach ($timePeriods as $timePeriod)
                                    {{-- Statistics By {{ $timePeriod }} --}}
                                    <tr class="px-6 py-4 text-xs text-gray-700 uppercase bg-gray-50 whitespace-no-wrap text-center">
                                        <td colspan="2" class="px-6 py-4 font-bold">{{  __("STATISTACS BY") }} {{ __("$timePeriod") }}</td>
                                    </tr>

                                    @foreach ($categories as $category)
                                        <x-table-row>
                                            <x-table-header>
                                                {{ __("Added") }} {{ __("$category") }}
                                            </x-table-header>
                                            <td class="px-6 py-4">
                                                {{ ${'statisticsBy'.$timePeriod}['created'.$category] }}
                                            </td>
                                        </x-table-row>
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
