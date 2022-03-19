<x-modal title="Lap Data">

    <canvas x-ref="canvas" class="my-4"></canvas>

    <span @click="openRawLaps = !openRawLaps"
          class="cursor-pointer text-indigo-600 dark:text-indigo-400 hover:text-indigo-900"
          x-text="openRawLaps ? 'Close Lap Data' : 'Open Lap Data'"
    ></span>

    <template x-if="laps && openRawLaps">
        <div class="mt-4 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-600">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-white sm:pl-6">
                        Lap
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                        Time
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                        Sectors
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-800">
                <template
                    x-for="(lap, idx) in laps"
                    :key="idx"
                >
                    <tr :class="idx % 2 == 0 ? '' : 'bg-gray-100 dark:bg-gray-600'">
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-gray-200"
                            x-text="idx + 1"></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-gray-200 text-right"
                            x-text="(lap.m_lapTimeInMS / 1000).toFixed(3)"></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-gray-200 text-right">
                            <span x-text="(lap.m_sector1TimeInMS / 1000).toFixed(3)" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100"></span>
                            <span x-text="(lap.m_sector2TimeInMS / 1000).toFixed(3)" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100"></span>
                            <span x-text="(lap.m_sector3TimeInMS / 1000).toFixed(3)" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100"></span>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </template>
</x-modal>
