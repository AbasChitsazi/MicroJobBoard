<x-admin-component.dashboard>

    <div class="flex items-center justify-between">
        <div>
            <x-admin-component.breadcrumbs class="mb-4" :links="['Application' => '#']" />
        </div>
        <div class="mb-3 flex items-center justify-between">
            <div class="ml-5">
                <form method="GET" action="{{ route('admin.application.index') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select name="filter" onchange="this.form.submit()"
                        class="px-2 py-1 border border-gray-500 rounded-md text-sm text-gray-700 focus:outline-none focus:ring focus:ring-emerald-300">
                        <option value="all" {{ request('filter', 'all') === 'all' ? 'selected' : '' }}>All</option>
                        <option value="approved" {{ request('filter') === 'approved' ? 'selected' : '' }}>Approved
                        </option>
                        <option value="declined" {{ request('filter') === 'declined' ? 'selected' : '' }}>Declined
                        </option>
                        <option value="pending" {{ request('filter') === 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <x-card>
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold mb-3 text-gray-800">📝 Application</h3>
            </div>
            <div>
                <div class="mb-3">
                    <form method="GET" action="{{ route('admin.application.index') }}" class="flex items-center">
                        <input class="w-40 h-7 border rounded px-2 mr-1" type="text" name="search"
                            value="{{ request('search') }}" placeholder="Search">

                        <button type="submit" class=" cursor-pointer px-1 bg-indigo-300 rounded-md w-8 h-7">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 border-b border-gray-300">
                        <th class="px-4 py-2 cursor-pointer">#</th>
                        <th class="px-4 py-2 cursor-pointer">Name</th>
                        <th class="px-4 py-2 cursor-pointer">Expected Salary</th>
                        <th class="px-4 py-2 cursor-pointer">Job</th>
                        <th class="px-4 py-2 cursor-pointer">Company</th>
                        <th class="px-4 py-2 cursor-pointer">Status</th>
                        <th class="px-4 py-2 cursor-pointer">Created At</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobApplications as $application)
                        <tr class="hover:bg-gray-100 border-b border-gray-200 text-xs cursor-pointer ">
                            <td class="px-4 py-2">{{ $application->id }}</td>
                            <td class="px-4 py-2"><a class="hover:underline"
                                    href="{{ route('admin.show.user', $application->user->id) }}">{{ $application->user->name }}</a>
                            </td>
                            <td class="px-4 py-2 text-emerald-500 ">${{ number_format($application->expected_salary) }}
                            </td>
                            <td class="px-4 py-2">{{ $application->job->title }}</td>
                            <td class="px-4 py-2"><a class="hover:underline"
                                    href="{{ route('admin.show.user', $application->job->employer->user->id) }}">{{ $application->job->employer->company_name }}</a>
                            </td>
                            <td class="px-4 py-2">
                                @if ($application->is_approved === null)
                                    <span
                                        class="px-2 py-1 text-xs font-semibold text-orange-700 bg-orange-100 rounded-full">Pending</span>
                                @elseif($application->is_approved)
                                    <span
                                        class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Approved</span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Declined</span>
                                @endif
                            </td>

                            <td class="px-4 py-2">{{ $application->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $jobApplications->links() }}
            </div>


        </div>

    </x-card>
</x-admin-component.dashboard>
