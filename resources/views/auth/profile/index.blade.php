<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Profile' => '#']" />
    <x-card class="space-y-4">
        <div class="flex items-center justify-between">
            <div><h2 class="text-xl font-semibold text-gray-800">Your Profile</h2></div>
            <div class="text-sm text-slate-500"><span class="font-medium">Member since:</span> {{ auth()->user()->created_at->format('F Y') }}</div>
        </div>


        <div class="flex items-center space-x-4 mt-6">
            <div class="w-13 h-13 rounded-full bg-gray-200  flex items-center justify-center text-2xl text-gray-600">
                <img src="{{ asset('images/profile.png') }}" alt="Profile picture">
            </div>
            <div>
                <p class="text-lg font-medium text-gray-700">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>
        <div class="mt-15">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Your Job Statistics</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('my-job-applications.index') }}">
                    <div class="rounded-lg border border-gray-200 p-4 shadow-sm bg-white">
                        <p class="text-gray-500 text-sm">Jobs Applied</p>
                        <p class=" font-bold text-emerald-600">
                            Active:
                            {{ auth()->user()->jobApplications()->whereHas('job', fn($q) => $q->whereNull('deleted_at'))->count() ?? 0 }}
                        </p>
                        <p class=" font-bold text-red-400">
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
                            <p class=" font-bold text-red-400">
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
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Your Sessions</h3>
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
                                    <div
                                        class="flex items-center justify-between cursor-pointer  text-white text-sm  px-3 py-1 rounded bg-red-400 hover:bg-red-500">
                                        <div><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                            </svg></div>
                                        <div><button class="cursor-pointer">Logout</button></div>
                                    </div>
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
            <div class="flex gap-3">
                <div>
                    <a href="{{ route('auth.profile.edit') }}"
                        class="inline-flex items-center gap-1 bg-emerald-500 text-white text-sm px-4 py-2 rounded hover:bg-emerald-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Edit Profile
                    </a>
                </div>

                @if (!is_null(auth()->user()->employer))
                    <div>
                        <a href="{{ route('auth.company.edit') }}"
                            class="inline-flex items-center gap-1 bg-indigo-500 text-white text-sm px-4 py-2 rounded hover:bg-indigo-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            Edit Company Name
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </x-card>
</x-layout>
