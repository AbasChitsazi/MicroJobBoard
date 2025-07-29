<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Profile' => '#']" />
    <x-card class="space-y-4">
        <h2 class="text-xl font-semibold text-gray-800">Your Profile</h2>

        <div class="flex items-center space-x-4">
            <div class="w-13 h-13 rounded-full bg-gray-200 flex items-center justify-center text-2xl text-gray-600">
                <img  src="{{asset('images/profile.png')}}" alt="Profile picture">
            </div>
            <div>
                <p class="text-lg font-medium text-gray-700">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 text-gray-600">
            <div><span class="font-medium">Member since:</span> {{ auth()->user()->created_at->format('F Y') }}</div>

        </div>
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Your Job Statistics</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('my-job-applications.index') }}">
                    <div class="rounded-lg border border-gray-200 p-4 shadow-sm bg-white">
                        <p class="text-gray-500 text-sm">Jobs Applied</p>
                        <p class=" font-bold text-emerald-600">
                            Active:
                            {{ auth()->user()->jobApplications()->whereHas('job', fn($q) => $q->whereNull('deleted_at'))->count() ?? 0 }}
                        </p>
                        <p class=" font-bold text-red-500">
                            Deleted:
                            {{ auth()->user()->jobApplications()->whereHas('job', fn($q) => $q->onlyTrashed())->count() ?? 0 }}
                        </p>
                    </div>
                </a>
                @if (!is_null(auth()->user()->employer))
                    <a href="{{ route('my-jobs.index') }}">
                        <div class="rounded-lg border border-gray-200 p-4 shadow-sm bg-white">
                            <div class="flex items-center justify-between">
                                <p class="text-gray-500 text-sm">Jobs Created</p>
                                <div class="text-xs">
                                    {{ auth()->user()->employer->company_name }}
                                </div>

                            </div>
                            <p class=" font-bold text-green-600">
                                Active: {{ auth()->user()->employer?->jobs()->count() ?? 0 }}
                            </p>
                            <p class=" font-bold text-red-500">
                                Deleted: {{ auth()->user()->employer?->jobs()->onlyTrashed()->count() ?? 0 }}
                            </p>
                        </div>
                    </a>
                @else
                @endif
            </div>
            @php
                $sessions = \Illuminate\Support\Facades\DB::table('sessions')
                    ->where('user_id', auth()->id())
                    ->get();
                $currentSessionId = session()->getId();
            @endphp

            <div class="mt-10">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Your Sessions</h3>
                <div class="rounded-lg border border-gray-200 p-4 shadow-sm bg-white">
                    @forelse ($sessions as $session)
                        <div
                            class="flex justify-between items-center mb-3 border-b border-gray-300 p-4 text-sm {{ $session->id === $currentSessionId ? 'bg-green-50 ' : '' }}">
                            <div>
                                <p>
                                    <strong>IP Address:</strong> {{ $session->ip_address ?? 'Unknown' }}
                                    @if ($session->id === $currentSessionId)
                                        <span class="text-green-600 font-semibold ml-2">(Current Session)</span>
                                    @endif
                                </p>
                                <p><strong>User Agent:</strong> {{ $session->user_agent ?? 'Unknown' }}</p>
                                <p><strong>Last Activity:</strong>
                                    {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                                </p>
                            </div>

                            @if ($session->id !== $currentSessionId)
                                <form method="POST" action="{{ route('sessions.destroy', $session->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="cursor-pointer bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">
                                        Logout
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">No sessions found.</p>
                    @endforelse
                </div>
            </div>

        </div>
        <div class="pt-6 flex items-center justify-between">
            <div class="flex">
                <div class="mr-3"><a href="{{ route('auth.profile.edit') }}"
                        class="inline-block bg-emerald-600 text-white text-sm px-4 py-2 rounded hover:bg-emerald-700 transition">
                        Edit Profile
                    </a></div>
                @if (!is_null(auth()->user()->employer))
                    <div><a href="{{ route('auth.company.edit') }}"
                            class="inline-block bg-indigo-600 text-white text-sm px-4 py-2 rounded hover:bg-indigo-700 transition">
                            Edit Company name
                        </a></div>
                @endif
            </div>

        </div>
    </x-card>
</x-layout>
