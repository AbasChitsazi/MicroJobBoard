<x-layout>
    <x-breadcrumbs class="mb-6" :links="['Profile' => '#']" />
    <x-card class="space-y-8">

        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-800">Your Profile</h2>
            <div class="text-sm text-slate-500"><span class="font-medium">Member since:</span> {{ auth()->user()->created_at->format('F Y') }}</div>
        </div>

        <div class="flex items-center space-x-6 mt-4">
            <div class="w-16 h-16 rounded-full bg-gray-200 border-2 border-white shadow flex items-center justify-center overflow-hidden">
                <img src="{{ auth()->user()->avatar_url ?? asset('images/profile.png') }}" alt="Profile picture" class="object-cover w-full h-full" />
            </div>
            <div>
                <p class="text-xl font-semibold text-gray-700">{{ auth()->user()->name }}</p>
                <div class="flex items-center">
                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                    <p class="text-xs ml-5 border border-md rounded-2xl px-2 h-fit {{auth()->user()->is_verified || auth()->user()->role === 'admin' ? 'border-green-700 bg-green-300 text-green-700' : 'border-red-700 bg-red-300 text-red-700'}}">{{auth()->user()->is_verified || auth()->user()->role === 'admin' ? 'verified' : 'unverified'}}</p>
                </div>
            </div>
        </div>
        <div>
            @if (!(auth()->user()->is_verified) && auth()->user()->role != 'admin')
                <a href="" class="border rounded-md px-2 py-2 text-sm border-red-400 bg-red-100 text-red-400" >Verify Your Email</a>
            @endif
        </div>

        <div class="border-t  border-gray-200 pt-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Your Job Statistics</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <a href="{{ route('my-job-applications.index') }}" class="group block rounded-lg border border-gray-200 p-6 bg-gradient-to-br from-white to-gray-50 hover:shadow-lg transition duration-300">
                    <p class="text-gray-500 text-sm mb-2">Jobs Applied</p>
                    <p class="text-sm font-semibold text-emerald-600">
                        Active: <span class="font-bold">{{ auth()->user()->jobApplications()->whereHas('job', fn($q) => $q->whereNull('deleted_at'))->count() ?? 0 }}</span>
                    </p>
                    <p class="text-sm font-semibold text-red-400">
                        Deleted: <span class="font-bold">{{ auth()->user()->jobApplications()->whereHas('job', fn($q) => $q->onlyTrashed())->count() ?? 0 }}</span>
                    </p>
                </a>

                @if (!is_null(auth()->user()->employer))
                    <a href="{{ route('my-jobs.index') }}" class="group block rounded-lg border border-gray-200 p-6 bg-gradient-to-br from-white to-gray-50 hover:shadow-lg transition duration-300">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-gray-500 text-sm">Jobs Created</p>
                            <div class="text-xs text-gray-400">{{ auth()->user()->employer->company_name }}</div>
                        </div>
                        <p class="text-sm font-semibold text-green-600">
                            Active: <span class="font-bold">{{ auth()->user()->employer?->jobs()->count() ?? 0 }}</span>
                        </p>
                        <p class="text-sm font-semibold text-red-400">
                            Deleted: <span class="font-bold">{{ auth()->user()->employer?->jobs()->onlyTrashed()->count() ?? 0 }}</span>
                        </p>
                    </a>
                @endif
            </div>
        </div>

        @php
            $sessions = \Illuminate\Support\Facades\DB::table('sessions')->where('user_id', auth()->id())->get();
            $currentSessionId = session()->getId();
        @endphp

        <div class="border-t border-gray-200 pt-8">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Your Sessions</h3>
            <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                @forelse ($sessions as $index => $session)
                    <div
                        class="flex justify-between items-center p-4 text-sm {{ $index % 2 == 0 ? 'bg-gray-50' : '' }} {{ $session->id === $currentSessionId ? 'bg-green-50 font-semibold' : '' }}">
                        <div>
                            <p><strong>IP Address:</strong> {{ $session->ip_address ?? 'Unknown' }}
                                @if ($session->id === $currentSessionId)
                                    <span class="text-green-600 font-semibold ml-2">(Current Session)</span>
                                @endif
                            </p>
                            <p><strong>User Agent:</strong> {{ $session->user_agent ?? 'Unknown' }}</p>
                            <p><strong>Last Activity:</strong> {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</p>
                        </div>
                        @if ($session->id !== $currentSessionId)
                            <form method="POST" action="{{ route('sessions.destroy', $session->id) }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="ml-4 p-1 cursor-pointer text-red-500 hover:bg-red-50 rounded transition"
                                    aria-label="Logout this session">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="p-4 text-gray-500">No sessions found.</p>
                @endforelse
            </div>
        </div>

        <div class="pt-8 flex items-center">
            <a href="{{ route('auth.profile.edit') }}"
                class="mr-3 inline-flex items-center gap-2 bg-emerald-400 text-white text-sm px-5 py-2 rounded hover:bg-emerald-500 transition shadow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                Edit Profile
            </a>

            @if (!is_null(auth()->user()->employer))
                <a href="{{ route('auth.company.edit') }}"
                    class="inline-flex items-center gap-2 bg-indigo-400 text-white text-sm px-5 py-2 rounded hover:bg-indigo-500 transition shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Edit Company
                </a>
            @endif
        </div>

    </x-card>
</x-layout>
