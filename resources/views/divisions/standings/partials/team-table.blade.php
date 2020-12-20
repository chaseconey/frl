<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Team
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Points
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($standings as $teamId => $teamDrivers)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="pl-4 border-l-4 {{ f1_team_color($teamDrivers->first()->f1Team->name) }}">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $teamDrivers->first()->f1Team->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $teamDrivers->pluck('user.name')->join(', ') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="text-sm text-gray-900">{{ $teamDrivers->sum->race_results_sum_points ?? 0 }}</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
