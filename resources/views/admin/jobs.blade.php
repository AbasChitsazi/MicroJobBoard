<x-admin-component.dashboard>
    <div class="flex items-center justify-between mb-4">
        <x-admin-component.breadcrumbs class="mb-4" :links="['Jobs' => route('admin.jobs.index')]" />

        <div class="flex items-center gap-4">

            <form method="GET" action="{{ route('admin.jobs.index') }}">
                <input type="hidden" name="filterbyexperience" value="{{ request('filterbyexperience') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <select name="filterbyjob" onchange="this.form.submit()"
                    class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 focus:outline-none focus:ring focus:ring-emerald-300">
                    <option value="" {{ request('filterbyjob') === '' ? 'selected' : '' }}>Category</option>
                    @foreach (\App\Models\Job::$jobcategory as $category)
                        <option value="{{ $category }}"
                            {{ request('filterbyjob') === $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </form>

            <form method="GET" action="{{ route('admin.jobs.index') }}">
                <input type="hidden" name="filterbyjob" value="{{ request('filterbyjob') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <select name="filterbyexperience" onchange="this.form.submit()"
                    class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 focus:outline-none focus:ring focus:ring-emerald-300">
                    <option value="" {{ request('filterbyexperience') === '' ? 'selected' : '' }}>Experience
                    </option>
                    @foreach (\App\Models\Job::$experience as $exp)
                        <option value="{{ $exp }}"
                            {{ request('filterbyexperience') === $exp ? 'selected' : '' }}>{{ $exp }}</option>
                    @endforeach
                </select>
            </form>



            <form method="GET" action="{{ route('admin.jobs.index') }}" class="flex items-center">
                <input type="hidden" name="filterbyjob" value="{{ request('filterbyjob') }}">
                <input type="hidden" name="filterbyexperience" value="{{ request('filterbyexperience') }}">
                <input
                    class="w-34 h-8 border border-gray-300 rounded-l-md px-2 text-sm focus:outline-none focus:ring focus:ring-emerald-300"
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
            📝 Jobs
        </h3>

        <div class="overflow-x-auto rounded-2xl shadow-2xs">
            <table class="w-full text-sm text-left text-gray-600 border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-xs uppercase border-b border-gray-300">
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Company</th>
                        <th class="px-4 py-2">Employer</th>
                        <th class="px-4 py-2">Salary</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">experience</th>
                        <th class="px-4 py-2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        <tr class="hover:bg-gray-50 even:bg-gray-50/100 text-xs transition">
                            {{-- Title --}}
                            <td class="px-4 py-2 relative group">
                                {{ $job->title }}

                                {{-- Tooltip --}}
                                <span
                                    class="absolute bottom-full left-0 mb-1 hidden group-hover:block bg-gray-800 text-white text-[11px] rounded px-2 py-1 whitespace-nowrap z-10">
                                    Total Applied: {{ $job->jobApplications->count() ?? 0 }}
                                </span>
                            </td>

                            {{-- Company Name --}}
                            <td class="px-4 py-2">{{ $job->employer->company_name }}</td>

                            {{-- Employer --}}
                            <td class="px-4 py-2 font-medium">
                                <a class="hover:text-sky-600 hover:underline"
                                    href="{{ route('admin.show.user', $job->employer->user->id) }}">
                                    {{ $job->employer->user->name }}
                                </a>
                            </td>

                            {{-- Salary --}}
                            <td class="px-4 py-2 text-emerald-600">${{ number_format($job->salary) }}</td>

                            {{-- Category --}}
                            <td class="px-4 py-2">
                                <span
                                    class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">
                                    {{ $job->category }}
                                </span>
                            </td>

                            {{-- Experience --}}
                            <td class="px-4 py-2">
                                <span
                                    class="px-2 py-1 text-xs font-semibold bg-orange-100 text-orange-700 rounded-full">
                                    {{ $job->experience }}
                                </span>
                            </td>

                            {{-- Created At --}}
                            <td class="px-4 py-2 text-gray-500 whitespace-nowrap w-40">
                                <div class="flex items-center gap-1">
                                    {{ $job->created_at ? $job->created_at->diffForHumans() : 'N/A' }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $jobs->links() }}
            </div>
        </div>
    </x-card>
</x-admin-component.dashboard>
