<x-admin-component.dashboard>
    <x-admin-component.breadcrumbs class="mb-4" :links="['Users' => route('admin.users'), $user->name => '#']" />

    <x-card class="p-6">
        <!-- User Header -->
        <div class="flex items-center justify-between b pb-6 mb-8">
            <div class="flex items-center space-x-4">
                <img src="{{ $user->avatar_url ?? asset('images/profile.png') }}" alt="{{ $user->name }}"
                    class="w-16 h-16 rounded-full border">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
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

        <!-- User Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Basic Information</h3>
                <p><span class="font-semibold">Name:</span> {{ $user->name }}</p>
                <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                <p><span class="font-semibold">Joined:</span> {{ $user->created_at->format('d M Y') }}</p>
                <p><span class="font-semibold">Last Login:</span>
                    <span class="">{{ $user->updated_at->diffForHumans() }}</span>
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
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
        <div class="w-full bg-gray-50 p-4 rounded-lg shadow-md mt-5">
            <h3 class="text-lg font-medium text-gray-700 mb-3">Last Activity</h3>

            @if ($user->employer && $user->employer->jobs->count() > 0)
                <div class="mb-4">
                    <h4 class="text-sm font-semibold text-gray-600 mb-2">Recent Jobs Posted</h4>
                    <ul class="space-y-2">
                        @foreach ($user->employer->jobs->take(3) as $job)
                            <li class="flex justify-between items-center bg-white p-2 rounded shadow-md">
                                <span>{{ $job->title }}</span>
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
                                <span>{{ $application->job->title }}</span>
                                <span
                                    class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            </div>
        </div>


        <!-- Actions -->
        <div class="mt-6 flex justify-end space-x-2">
            <a href="{{ route('admin.users') }}"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Back
            </a>
            <a href="{{route('auth.profile.edit')}}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Edit
            </a>
            <form method="POST" action=""
                onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </x-card>
</x-admin-component.dashboard>
