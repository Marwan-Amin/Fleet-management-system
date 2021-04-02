<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trips') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div>
        <table class="min-w-full table-auto">
            <thead class="justify-between">
                <tr class="bg-gray-800">
                    <th class="px-16 py-2">
                        <span class="text-gray-300">Bus name</span>
                    </th>
                    <th class="px-16 py-2">
                        <span class="text-gray-300">Available seats</span>
                    </th>
                    <th class="px-16 py-2">
                        <span class="text-gray-300">Starting station</span>
                    </th>

                    <th class="px-16 py-2">
                        <span class="text-gray-300">Ending station</span>
                    </th>
                    <th class="px-16 py-2">
                        <span class="text-gray-300">Departure time</span>
                    </th>
                    <th class="px-16 py-2">
                        <span class="text-gray-300">Arrival time</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-gray-200 text-center">
                <tr class="bg-white border-4 border-gray-200">
                    <td>
                        <span class="text-center ml-2 font-semibold">Dean Lynch</span>
                    </td>
                    <td>
                        <span class="text-center ml-2 font-semibold">Dean Lynch</span>
                    </td>
                    <td class="px-16 py-2">
                        <span>05/06/2020</span>
                    </td>
                    <td class="px-16 py-2">
                        <span>10:00</span>
                    </td>
                    <td>
                        <span class="text-center ml-2 font-semibold">Dean Lynch</span>
                    </td>
                    <td>
                        <span class="text-center ml-2 font-semibold">Dean Lynch</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
