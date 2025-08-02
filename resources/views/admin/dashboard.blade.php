<x-admin-component.dashboard>
    <x-admin-component.breadcrumbs class="mb-4" :links="['Dashboard' => route('admin.dashboard')]" />

    <x-card>
        <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
            📊 Dashboard Summary
        </h2>

        <div class="space-y-8">

            {{-- Latest Jobs --}}
            <div class="bg-white rounded-xl shadow p-5 border border-gray-100 hover:shadow-lg transition duration-300 hover:scale-[1.01]">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                    📌 Latest Jobs
                </h3>
                <div class="overflow-x-auto rounded-2xl shadow-2xs">
                    <table class="w-full text-sm text-left text-gray-600 border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-xs uppercase">
                                <th class="px-4 py-2">Company</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Location</th>
                                <th class="px-4 py-2">Salary</th>
                                <th class="px-4 py-2">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestJobs as $job)
                                <tr class="hover:bg-gray-50 even:bg-gray-50/50 text-xs cursor-pointer transition">
                                    <td class="px-4 py-2">
                                        <a href="{{ route('jobs.show', $job) }}" class="hover:underline hover:text-sky-600">
                                            {{ $job->employer->company_name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">{{ $job->title }}</td>
                                    <td class="px-4 py-2">{{ $job->location }}</td>
                                    <td class="px-4 py-2 font-medium text-green-600">
                                        ${{ number_format($job->salary) }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-500">{{ $job->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-400 text-sm">No jobs available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Latest Applications --}}
            <div class="bg-white rounded-xl shadow p-5 border border-gray-100 hover:shadow-lg transition duration-300 hover:scale-[1.01]">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                    📝 Latest Applications
                </h3>
                <div class="overflow-x-auto rounded-2xl shadow-2xs">
                    <table class="w-full text-sm text-left text-gray-600 border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-xs uppercase">
                                <th class="px-4 py-2">User</th>
                                <th class="px-4 py-2">Job</th>
                                <th class="px-4 py-2">Expected Salary</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestapllied as $application)
                                <tr class="hover:bg-gray-50 even:bg-gray-50/50 text-xs transition">
                                    <td class="px-4 py-2">{{ $application->user->name }}</td>
                                    <td class="px-4 py-2">{{ $application->job->title }}</td>
                                    <td class="px-4 py-2 font-medium text-green-600">
                                        ${{ number_format($application->expected_salary) }}
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($application->is_approved === null)
                                            <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">Pending</span>
                                        @elseif($application->is_approved)
                                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Approved</span>
                                        @else
                                            <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full">Declined</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-400 text-sm">No job applications yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Latest Signups --}}
            <div class="bg-white rounded-xl shadow p-5 border border-gray-100 hover:shadow-lg transition duration-300 hover:scale-[1.01]">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
                    👤 Latest Signups
                </h3>
                <div class="overflow-x-auto rounded-2xl shadow-2xs">
                    <table class="w-full text-sm text-left text-gray-600 border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-xs uppercase">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Signup Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestusers as $user)
                                <tr class="hover:bg-gray-50 even:bg-gray-50/50 text-xs transition">
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.show.user', $user) }}" class="hover:underline hover:text-sky-600">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2 text-gray-500">{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-gray-400 text-sm">No users signed up yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-card>
</x-admin-component.dashboard>
