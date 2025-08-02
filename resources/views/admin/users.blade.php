<x-admin-component.dashboard>
    <div class="flex items-center justify-between">
        <div>
            <x-admin-component.breadcrumbs class="mb-4" :links="['Users' => route('admin.users')]" />
        </div>
        <div class="mb-3 flex items-center justify-between">
            <div class="ml-5">
                <form method="GET" action="{{ route('admin.users') }}">
                    <select name="filter" onchange="this.form.submit()"
                        class="px-2 py-1 border border-gray-500 rounded-md text-sm text-gray-700 focus:outline-none focus:ring focus:ring-emerald-300">
                        <option value="" {{ request('filter') === null ? 'selected' : '' }}>All</option>
                        <option value="admin" {{ request('filter') === 'admin' ? 'selected' : '' }}>Admin
                        </option>
                        <option value="employer" {{ request('filter') === 'employer' ? 'selected' : '' }}>Employer
                        </option>
                        <option value="jobseeker" {{ request('filter') === 'jobseeker' ? 'selected' : '' }}>
                            JobSeekers</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <x-card>
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold mb-3 text-gray-800">👤 Users</h3>
            </div>
            <div>
                <div class="mb-3">
                    <form method="GET" action="{{ route('admin.users') }}" class="flex items-center">
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
                        <th class="px-4 py-2 cursor-pointer">Email</th>
                        <th class="px-4 py-2 cursor-pointer">Jobs Applied</th>
                        <th class="px-4 py-2 cursor-pointer">Created Jobs</th>
                        <th class="px-4 py-2 cursor-pointer">Created At</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-100 border-b border-gray-200 text-xs cursor-pointer ">
                            <td class="px-4 py-2">
                                <img src="{{ $user->avatar_url }}" alt="Profile picture"
                                    class="object-cover rounded-full w-10 h-10" />
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.show.user', $user) }}"
                                    class="flex items-center gap-1 text-black hover:underline">
                                    <span>{{ $user->name }}</span>
                                    @if ($user->is_locked)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                        </svg>
                                    @endif
                                </a>
                            </td>
                            <td class="px-4 py-2">{{ $user->email }}</td>

                            <td class="px-4 py-2">
                                {{ $user->jobApplications->count() ? $user->jobApplications->count() : '-' }}</td>
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
