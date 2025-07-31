<x-card class="mb-4 bg-white hover:shadow-md hover:scale-[1.01] transition-all duration-300 rounded-lg border border-slate-200">
    <div class="mb-4 flex justify-between items-start">
        <div>
            <a href="{{ $job->deleted_at ? '#' : route('my-jobs.show', $job) }}">
                @if ($job->deleted_at)
                    <div class="flex items-center space-x-2">
                        <h2 class="text-lg font-medium line-through text-red-400">{{ $job->title }}</h2>
                        <span class="px-2 py-0.5 text-xs font-semibold bg-red-100 text-red-600 rounded-full">
                            Deleted
                        </span>
                    </div>
                @else
                    <h2 class="text-lg font-medium text-slate-800 hover:text-blue-600 transition">
                        {{ $job->title }}
                    </h2>
                @endif
            </a>
            <p class="text-xs text-slate-400 mt-1">
                Posted on {{ $job->created_at->format('F j, Y') }}
            </p>
        </div>
        <div class="text-emerald-600 font-semibold text-base">
            ${{ number_format($job->salary) }}
        </div>
    </div>

    <div class="mb-4 flex justify-between text-sm text-slate-600 items-center">
        <div class="flex gap-x-4 items-center">
            <div class="flex items-center gap-x-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                </svg>
                {{ $job->employer->company_name }}
            </div>
            <div class="flex items-center gap-x-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                </svg>
                {{ $job->location }}
            </div>
        </div>

        <div class="flex gap-2">
            <x-tag>
                <a href="{{ route('jobs.index', ['experience' => $job->experience]) }}">
                    {{ Str::ucfirst($job->experience) }}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{ route('jobs.index', ['category' => $job->category]) }}">
                    {{ $job->category }}
                </a>
            </x-tag>
        </div>
    </div>

    {{ $slot }}
</x-card>
