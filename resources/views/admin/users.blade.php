<x-admin-component.dashboard>
    <div class="flex items-center justify-between mb-4">
        <x-admin-component.breadcrumbs :links="['Users' => route('admin.users')]" />

        {{-- Filter & Search --}}
        <div class="flex items-center gap-4">
            {{-- Filter Dropdown --}}
            <form method="GET" action="{{ route('admin.users') }}">
                <select name="filter" onchange="this.form.submit()"
                    class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 focus:outline-none focus:ring focus:ring-emerald-300">
                    <option value="" {{ request('filter') === null ? 'selected' : '' }}>All</option>
                    <option value="admin" {{ request('filter') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="employer" {{ request('filter') === 'employer' ? 'selected' : '' }}>Employer</option>
                    <option value="jobseeker" {{ request('filter') === 'jobseeker' ? 'selected' : '' }}>Job Seekers</option>
                </select>
            </form>

            {{-- Search --}}
            <form method="GET" action="{{ route('admin.users') }}" class="flex items-center">
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

    <x-card>
        <h3 class="text-lg font-semibold mb-4 text-gray-800 flex items-center gap-2">
            👤 Users List
        </h3>

        <div class="overflow-x-auto rounded-2xl shadow-2xs">
            <table class="w-full text-sm text-left text-gray-600 border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-xs uppercase border-b border-gray-300">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Jobs Applied</th>
                        <th class="px-4 py-2">Created Jobs</th>
                        <th class="px-4 py-2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 even:bg-gray-50/100 text-xs transition">
                            {{-- Avatar --}}
                            <td class="px-4 py-2">
                                <img src="{{ $user->avatar_url }}" alt="Profile picture"
                                    class="object-cover rounded-full w-14 h-10 border border-gray-200" />
                            </td>

                            {{-- Name --}}
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.show.user', $user) }}"
                                    class="flex items-center gap-1 text-gray-800 hover:underline">
                                    <span>{{ $user->name }}</span>
                                    @if ($user->is_locked)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                        </svg>
                                    @endif
                                </a>
                            </td>

                            {{-- Email --}}
                            <td class="px-4 py-2">{{ $user->email }}</td>

                            {{-- Jobs Applied --}}
                            <td class="px-4 py-2">
                                @if ($user->jobApplications->count())
                                    <span class="flex items-center gap-1 bg-blue-100 text-blue-700 text-xs font-medium px-2 py-0.5 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Zm-8 7h8a4 4 0 0 1 4 4v1H4v-1a4 4 0 0 1 4-4Z" />
                                        </svg>
                                        {{ $user->jobApplications->count() }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>

                            {{-- Created Jobs --}}
                            <td class="px-4 py-2">
                                @if ($user->employer?->jobs->count())
                                    <span class="flex items-center gap-1 bg-green-100 text-green-700 text-xs font-medium px-2 py-0.5 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                        {{ $user->employer->jobs->count() }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>

                            {{-- Created At --}}
                            <td class="px-4 py-2 flex items-center gap-1 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8 7V3m8 4V3m-9 8h10m-11 4h12m-13 4h14M4 7h16M4 21h16" />
                                </svg>
                                {{ $user->created_at->diffForHumans() }}
                            </td>
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
