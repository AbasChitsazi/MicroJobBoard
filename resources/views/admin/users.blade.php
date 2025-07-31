<x-admin-component.dashboard>
    <div class="flex items-center justify-between">
        <div>
            <x-admin-component.breadcrumbs class="mb-4" :links="['Dashboard' => route('admin.dashboard')]" />
        </div>
        <div class="mb-3">
            <form method="GET" action="{{ route('admin.users') }}">
                <select name="filter" onchange="this.form.submit()"
                    class="px-2 py-1 border border-gray-500 rounded-md text-sm text-gray-700 focus:outline-none focus:ring focus:ring-emerald-300">
                    <option value="" {{ request('filter') === null ? 'selected' : '' }}>All</option>
                    <option value="employer" {{ request('filter') === 'employer' ? 'selected' : '' }}>Employer</option>
                    <option value="jobseeker" {{ request('filter') === 'jobseeker' ? 'selected' : '' }}>JobSeekers</option>
                </select>
            </form>
        </div>
    </div>    <x-card>
            <h3 class="text-lg font-semibold mb-3 text-gray-800">👤 Users</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead>
                        <tr class="bg-gray-50 text-gray-700 border-b border-gray-300">
                            <th class="px-4 py-2 cursor-pointer">ID</th>
                            <th class="px-4 py-2 cursor-pointer">Name</th>
                            <th class="px-4 py-2 cursor-pointer">Email</th>
                            <th class="px-4 py-2 text-center cursor-pointer">Employer</th>
                            <th class="px-4 py-2 cursor-pointer">Jobs Applied</th>
                            <th class="px-4 py-2 cursor-pointer">Created Jobs</th>
                            <th class="px-4 py-2 cursor-pointer">Created At</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-100 border-b border-gray-200 text-xs cursor-pointer">
                                <td class="px-4 py-2">
                                    {{-- <a href="{{ route('admin-users.show', $user) }}"
                                        class="text-blue-600 hover:underline"> --}}
                                        {{ $user->id }}
                                    {{-- </a> --}}
                                </td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2 flex justify-center">
                                    @if ($user->employer)
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $user->jobApplications->count() ?? 0 }}</td>
                                <td class="px-4 py-2">{{ $user->employer?->jobs->count() ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>


            </div>
    </x-card>
</x-admin-component.dashboard>
