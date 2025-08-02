<x-admin-component.dashboard>
    <x-admin-component.breadcrumbs class="mb-4" :links="['Users' => route('admin.users'), $user->name => '#']" />

    <x-card class="p-6">

        <div class="flex items-center justify-between pb-6 mb-8 border-b border-gray-200">
            <div class="flex items-center space-x-5">
                <img src="{{ asset('images/profile.png') }}" alt="{{ $user->name }}"
                    class="w-16 h-16 rounded-full shadow-lg object-cover">

                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                        {{ $user->name }}
                        @if($user->is_locked)
                            <span class="px-2 py-0.5 rounded-full bg-orange-100 text-orange-700 text-xs font-semibold" title="Locked Account">🔒</span>
                        @endif
                        @if ($user->role === 'admin')
                            <span class="px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold" title="Admin User">⭐ Admin</span>
                        @else
                            <span class="px-2 py-0.5 rounded-full {{ $user->is_verified ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-xs font-semibold" title="{{ $user->is_verified ? 'Verified User' : 'Unverified User' }}">
                                {{ $user->is_verified ? '✔ Verified' : '❌ Unverified' }}
                            </span>
                        @endif
                    </h2>

                    <p class="text-sm text-gray-600 mt-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m0 0v-4m0 4v4m8-8v8" />
                        </svg>
                        {{ $user->email }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-2 text-sm font-semibold">
                @if ($user->employer)
                    <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 hover:bg-green-200 cursor-default select-none" title="Employer Role">
                        🏢 Employer
                    </span>
                @endif
                @if ($user->jobApplications->count() > 0)
                    <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 cursor-default select-none" title="Job Seeker Role">
                        🎯 Job Seeker
                    </span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <section
                class="bg-gray-50 p-6 rounded-lg shadow hover:shadow-md transition transform hover:scale-[1.02] duration-300 ease-in-out">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Basic Information
                </h3>
                <ul class="space-y-2 text-gray-700">
                    <li><strong>Name:</strong> {{ $user->name }}</li>
                    <li><strong>Email:</strong> {{ $user->email }}</li>
                    <li><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</li>
                    <li><strong>Last Activity:</strong> {{ $user->updated_at->diffForHumans() }}</li>
                </ul>
            </section>

            <section
                class="bg-gray-50 p-6 rounded-lg shadow hover:shadow-md transition transform hover:scale-[1.02] duration-300 ease-in-out">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 12h4m-4 5h6" />
                    </svg>
                    Additional Details
                </h3>
                @if ($user->employer)
                    <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4">
                        <p><strong>Company:</strong> {{ $user->employer->company_name ?? 'N/A' }}</p>
                        <p><strong>Total Jobs:</strong> {{ $user->employer->jobs->count() ?? 0 }}</p>
                    </div>
                @endif

                @if ($user->jobApplications->count() > 0)
                    <div class="bg-blue-100 text-blue-700 p-3 rounded-md">
                        <p><strong>Total Job Applications:</strong> {{ $user->jobApplications->count() }}</p>
                    </div>
                @endif

                @if (!$user->employer && $user->jobApplications->count() === 0)
                    <p class="text-gray-500 italic">No additional details available.</p>
                @endif
            </section>
        </div>

        <section
            class="bg-gray-50 p-6 rounded-lg shadow mt-6 hover:shadow-md transition transform hover:scale-[1.02] duration-300 ease-in-out">
            <h3 class="text-lg font-semibold text-gray-700 mb-5 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                </svg>
                Recent Activity
            </h3>

            @if ($user->employer && $user->employer->jobs->count() > 0)
                <div class="mb-6">
                    <h4 class="text-sm font-semibold text-gray-600 mb-3">Recent Jobs Posted</h4>
                    <ul class="space-y-2">
                        @foreach ($user->employer->jobs->take(3) as $job)
                            <li class="flex justify-between items-center bg-white p-3 rounded shadow-sm hover:bg-gray-50 transition">
                                <span>{{ $job->title ?? '- Job Deleted -' }}</span>
                                <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($user->jobApplications->count() > 0)
                <div>
                    <h4 class="text-sm font-semibold text-gray-600 mb-3">Recent Job Applications</h4>
                    <ul class="space-y-2">
                        @foreach ($user->jobApplications->take(3) as $application)
                            <li class="flex justify-between items-center bg-white p-3 rounded shadow-sm hover:bg-gray-50 transition">
                                <span>{{ $application->job?->title ?? '- Job Deleted -' }}</span>
                                <span class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ((!$user->employer || $user->employer->jobs->count() === 0) && $user->jobApplications->count() === 0)
                <p class="text-gray-500 italic">No recent activity available.</p>
            @endif
        </section>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('admin.edit.user', $user) }}"
                class="flex items-center gap-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487 18.55 2.8a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                </svg>
                Edit User
            </a>

            @if(auth()->user()->id !== $user->id)
                <form method="POST" action="{{ route('admin.delete.user', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex items-center gap-1 px-4 py-2 cursor-pointer bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Delete User
                    </button>
                </form>

                <form action="{{ route('admin.lock.user', $user) }}" method="post" onsubmit="return confirm('Are you sure you want to perform this action?');" class="inline">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-1 px-4 py-2 cursor-pointer bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition duration-200">
                        @if ($user->is_locked)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            Unlock User
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            Lock User
                        @endif
                    </button>
                </form>
            @endif

            <a href="{{ route('admin.users') }}" class="flex items-center gap-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                Back to Users
            </a>
        </div>

    </x-card>
</x-admin-component.dashboard>
