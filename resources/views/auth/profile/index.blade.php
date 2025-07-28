<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Profile' => '#']" />
    <x-card class="space-y-4">
        <h2 class="text-xl font-semibold text-gray-800">Your Profile</h2>

        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-2xl text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-9">
                    <path fill-rule="evenodd"
                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="text-lg font-medium text-gray-700">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 text-gray-600">
            <div><span class="font-medium">Member since:</span> {{ auth()->user()->created_at->format('F Y') }}</div>

        </div>
        <div class="text-gray-600">
            <div>
                <span class="font-medium">Last Update:
                </span>{{ auth()->user()->updated_at->diffForHumans() }}
            </div>
        </div>
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Your Job Statistics</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('my-job-applications.index') }}">
                    <div class="rounded-lg border border-gray-200 p-4 shadow-sm bg-white">
                        <p class="text-gray-500 text-sm">Jobs Applied</p>
                        <p class="text-2xl font-bold text-emerald-600">
                            {{ auth()->user()->jobApplications()->count() }}
                        </p>
                    </div>
                </a>
                @if (!is_null(auth()->user()->employer))
                    <a href="{{ route('my-jobs.index') }}">
                        <div class="rounded-lg border border-gray-200 p-4 shadow-sm bg-white">
                            <div class="flex items-center justify-between text-xs">
                                <p class="text-gray-500 ">Jobs Created</p>
                                <div>
                                    {{ auth()->user()->employer->company_name }}
                                </div>

                            </div>
                            <p class="text-2xl font-bold text-indigo-600">
                                {{ auth()->user()->employer?->jobs()->count() ?? 0 }}
                            </p>
                        </div>
                    </a>
                @else
                @endif

            </div>
        </div>
        <div class="pt-6 flex items-center justify-between">
            <div class="flex">
                <div class="mr-3"><a href="{{ route('auth.profile.edit') }}"
                    class="inline-block bg-emerald-600 text-white text-sm px-4 py-2 rounded hover:bg-emerald-700 transition">
                    Edit Profile
                </a></div>
                <div><a href="{{ route('auth.company.edit') }}"
                    class="inline-block bg-indigo-600 text-white text-sm px-4 py-2 rounded hover:bg-indigo-700 transition">
                    Edit Company name
                </a></div>
            </div>

        </div>
    </x-card>
</x-layout>
