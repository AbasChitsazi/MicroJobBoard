<x-admin-component.dashboard>

    <x-admin-component.breadcrumbs class="mb-4" :links="['Dashboard' => route('admin.dashboard')]" />

    <x-card class="">
        <h2 class="text-xl font-semibold mb-4">Dashboard Summary</h2>

        <div>
            <!-- Latest Jobs -->
            <div class="bg-white rounded-xl mb-8 shadow p-4 border border-gray-100 hover:shadow-md transition 500 hover:scale-[1.01] ">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">📌 Latest Jobs</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700">
                                <th class="px-4 py-2">Company</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Location</th>
                                <th class="px-4 py-2">Salary</th>
                                <th class="px-4 py-2">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestJobs as $jobs)
                                <tr class="hover:bg-gray-50 text-xs cursor-pointer">
                                    <td class="px-4 py-2">
                                        <a href="{{ route('jobs.show', $jobs) }}" class="hover:underline">
                                            {{ $jobs->employer->company_name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">{{ $jobs->title }}</td>
                                    <td class="px-4 py-2">{{ $jobs->location }}</td>
                                    <td class="px-4 py-2">${{ number_format($jobs->salary) }}</td>
                                    <td class="px-4 py-2">{{ $jobs->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>


            <!-- Latest Applied -->
            <div class="bg-white rounded-xl mb-8 shadow p-4 border border-gray-100  hover:shadow-md transition 500 hover:scale-[1.01] ">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">📝 Latest Applied</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700">
                                <th class="px-4 py-2">Job</th>
                                <th class="px-4 py-2">User</th>
                                <th class="px-4 py-2">Expected Salary</th>
                                <th class="px-4 py-2">Satatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestapllied as $application)
                                <tr class="hover:bg-gray-50 text-xs">
                                    <td class="px-4 py-2">{{ $application->job->title }}</td>
                                    <td class="px-4 py-2">{{ $application->user->name }}</td>
                                    <td class="px-4 py-2">${{ number_format($application->expected_salary) }}</td>
                                    <td class="px-4 py-2">
                                        {{ $application->is_approved === null ? 'Pending' : ($application->is_approved == 1 ? 'approved' : 'decline') }}
                                    </td>
                                </tr>

                            @empty
                                no job Application yet
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Latest Signups -->
            <div class="bg-white rounded-xl mb-8 shadow p-4 border border-gray-100  hover:shadow-md transition 500 hover:scale-[1.01] ">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">👤 Latest Signups</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Sign up At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestusers as $users)
                                <tr class="hover:bg-gray-50 text-xs">
                                    <td class="px-4 py-2">{{ $users->name }}</td>
                                    <td class="px-4 py-2">{{ $users->email }}</td>
                                    <td class="px-4 py-2">{{ $users->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                No user sign up yet
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-card>
</x-admin-component.dashboard>
