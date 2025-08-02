<x-admin-component.dashboard>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <x-admin-component.breadcrumbs :links="['Application' => route('admin.application.index')]" />

        <div class="flex items-center gap-4">
            {{-- Filter --}}
            <form method="GET" action="{{ route('admin.application.index') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <select name="filter" onchange="this.form.submit()"
                    class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 focus:outline-none focus:ring focus:ring-emerald-300">
                    <option value="all" {{ request('filter', 'all') === 'all' ? 'selected' : '' }}>All</option>
                    <option value="approved" {{ request('filter') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="declined" {{ request('filter') === 'declined' ? 'selected' : '' }}>Declined</option>
                    <option value="pending" {{ request('filter') === 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </form>

            {{-- Search --}}
            <form method="GET" action="{{ route('admin.application.index') }}" class="flex items-center">
                <input class="w-44 h-8 border border-gray-300 rounded-l-md px-2 text-sm focus:outline-none focus:ring focus:ring-emerald-300"
                    type="text" name="search" value="{{ request('search') }}" placeholder="Search">
                <button type="submit"
                    class="bg-emerald-500 text-white px-3 h-8 rounded-r-md hover:bg-emerald-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    {{-- Card --}}
    <x-card>
        <h3 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
            📝 Applications
        </h3>

        <div class="overflow-x-auto rounded-2xl shadow-2xs">
            <table class="w-full text-sm text-left text-gray-600 border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-xs uppercase border-b border-gray-300">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Expected Salary</th>
                        <th class="px-4 py-2">Job</th>
                        <th class="px-4 py-2">Company</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobApplications as $application)
                        <tr class="hover:bg-gray-50 even:bg-gray-50/100 text-xs transition">
                            {{-- ID --}}
                            <td class="px-4 py-2">{{ $application->id }}</td>

                            {{-- Name --}}
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.show.user', $application->user->id) }}"
                                    class="hover:underline hover:text-sky-600">
                                    {{ $application->user->name }}
                                </a>
                            </td>

                            {{-- Salary --}}
                            <td class="px-4 py-2 font-medium text-emerald-600">
                                ${{ number_format($application->expected_salary) }}
                            </td>

                            {{-- Job --}}
                            <td class="px-4 py-2">{{ $application->job->title }}</td>

                            {{-- Company --}}
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.show.user', $application->job->employer->user->id) }}"
                                    class="hover:underline hover:text-sky-600">
                                    {{ $application->job->employer->company_name }}
                                </a>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-2">
                                @if ($application->is_approved === null)
                                    <a href="?filter=pending"
                                        class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full hover:bg-yellow-200">
                                        Pending
                                    </a>
                                @elseif($application->is_approved)
                                    <a href="?filter=approved"
                                        class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full hover:bg-green-200">
                                        Approved
                                    </a>
                                @else
                                    <a href="?filter=declined"
                                        class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full hover:bg-red-200">
                                        Declined
                                    </a>
                                @endif
                            </td>

                            {{-- Created At --}}
                            <td class="px-4 py-2 flex items-center gap-1 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8 7V3m8 4V3m-9 8h10m-11 4h12m-13 4h14M4 7h16M4 21h16" />
                                </svg>
                                {{ $application->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $jobApplications->links() }}
            </div>
        </div>
    </x-card>
</x-admin-component.dashboard>
