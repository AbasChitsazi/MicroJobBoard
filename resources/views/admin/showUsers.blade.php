<x-admin-component.dashboard>
    <x-admin-component.breadcrumbs class="mb-4" :links="['Users' => route('admin.users'), $user->name => '#']" />

    <x-card class="p-6">

        <div class="flex items-center justify-between b pb-6 mb-8">
            <div class="flex items-center space-x-4">
                <img src="{{ $user->avatar_url ?? asset('images/profile.png') }}" alt="{{ $user->name }}"
                    class="w-16 h-16 rounded-full shadow-lg">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                    <div class="flex items-center">
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        @if ($user->is_locked)
                            <p
                                class="text-xs ml-1 border border-md rounded-2xl px-2 h-fit border-orange-700 bg-orange-300 text-orange-700">
                                Locked</p>
                        @else
                            <p
                                class="text-xs ml-5 border border-md rounded-2xl px-2 h-fit {{ $user->is_verified || $user->role === 'admin' ? 'border-green-700 bg-green-300 text-green-700' : 'border-red-700 bg-red-300 text-red-700' }}">
                                {{ $user->is_verified || $user->role === 'admin' ? 'verified' : 'unverified' }}</p>
                            @if ($user->role == 'admin')
                                <p
                                    class="text-xs ml-1 border border-md rounded-2xl px-2 h-fit border-yellow-700 bg-yellow-300 text-yellow-700">
                                    Admin</p>
                            @endif


                        @endif

                    </div>
                </div>
            </div>
            <div>
                <span
                    class="px-3 py-1 text-sm rounded-full
                    {{ $user->employer ? 'bg-green-100 text-green-700' : '' }}">
                    {{ $user->employer ? 'Employer' : '' }}

                </span>
                <span
                    class="px-3 py-1 text-sm rounded-full {{ $user->jobApplications->count() > 0 ? 'bg-blue-100 text-blue-700' : '' }} ">
                    {{ $user->jobApplications->count() > 0 ? 'JobSeeker' : '' }}
                </span>
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg shadow  hover:shadow-md transition 500 hover:scale-[1.01] ">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Basic Information</h3>
                <p><span class="font-semibold">Name:</span> {{ $user->name }}</p>
                <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                <p><span class="font-semibold">Joined:</span> {{ $user->created_at->format('d M Y') }}</p>
                <p><span class="font-semibold">Last Activity:</span>
                    <span class="">{{ $user->updated_at->diffForHumans() }}</span>
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow  hover:shadow-md transition 500 hover:scale-[1.01] ">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Additional Details</h3>
                @if ($user->employer)
                    <div class="bg-green-100 text-green-700 p-2 rounded-md">
                        <p><span class="font-semibold">Company:</span> {{ $user->employer->company_name ?? 'N/A' }}</p>
                        <p><span class="font-semibold">Total Jobs:</span> {{ $user->employer->jobs->count() ?? 'N/A' }}
                        </p>
                    </div>
                @endif
                @if ($user->jobApplications->count() > 0)
                    <div class="bg-blue-100 text-blue-700 p-2 rounded-md mt-3">
                        <p><span class="font-semibold ">Total Job Applied:</span>
                            {{ $user->jobApplications->count() ?? 0 }}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="w-full bg-gray-50 p-4 rounded-lg shadow mt-5  hover:shadow-md transition 500 hover:scale-[1.01] ">
            <h3 class="text-lg font-medium text-gray-700 mb-3">Last Activity</h3>

            @if ($user->employer && $user->employer->jobs->count() > 0)
                <div class="mb-4">
                    <h4 class="text-sm font-semibold text-gray-600 mb-2">Recent Jobs Posted</h4>
                    <ul class="space-y-2">
                        @foreach ($user->employer->jobs->take(3) as $job)
                            <li class="flex justify-between items-center bg-white p-2 rounded shadow-md">
                                <span>{{ $job->title ?? '- Job Deleted -' }}</span>
                                <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($user->jobApplications->count() > 0)
                <div class="mb-4">
                    <h4 class="text-sm font-semibold text-gray-600 mb-2">Recent Job Applications</h4>
                    <ul class="space-y-2">
                        @foreach ($user->jobApplications->take(3) as $application)
                            <li class="flex justify-between items-center bg-white p-2 rounded shadow-md">
                                <span>{{ $application->job?->title ?? '- Job Deleted -' }}</span>
                                <span
                                    class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
        </div>



        <div class="mt-6 flex justify-end space-x-2">
            <div
                class="flex items-center cursor-pointer px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                <a href="{{ route('admin.users') }}" class="ml-0.5">
                    Back
                </a>

            </div>
            <div class="flex items-center cursor-pointer px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <a href="{{ route('admin.edit.user', $user) }}" class="ml-0.5">
                    Edit
                </a>
            </div>
            @if (auth()->user()->id !== $user->id)
                <form method="POST" action="{{ route('admin.delete.user', $user) }}"
                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <div
                        class="flex items-center cursor-pointer px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-500">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16
                                          19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0
                                          1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0
                                          0-3.478-.397m-12 .562c.34-.059.68-.114
                                          1.022-.165m0 0a48.11 48.11 0 0 1
                                          3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964
                                          51.964 0 0 0-3.32 0c-1.18.037-2.09
                                          1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        <button type="submit" class="cursor-pointer ml-0.5">
                            Delete
                        </button>
                    </div>
                </form>
                <form action="{{ route('admin.lock.user', $user) }}" method="post"
                    onsubmit="return confirm('Are you sure you want to this action?');">
                    @csrf
                    @if ($user->is_locked)
                        <div
                            class="flex items-center  cursor-pointer px-4 py-2 bg-orange-400 text-white rounded-lg hover:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>

                            <button type="submit" class="cursor-pointer ml-0.5">
                                Unlock
                            </button>
                        </div>
                    @else
                        <div
                            class="flex items-center  cursor-pointer px-4 py-2 bg-orange-400 text-white rounded-lg hover:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>

                            <button type="submit" class="cursor-pointer ml-0.5">
                                Lock
                            </button>
                        </div>
                    @endif
                </form>
            @endif
        </div>
    </x-card>
</x-admin-component.dashboard>
