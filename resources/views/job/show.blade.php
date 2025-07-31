<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
    <x-job-card :$job>
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description)) !!}
        </p>
        @guest
            <div class="text-center text-sm font-medium text-red-400 border-2 border-red-300 bg-red-100 rounded-md p-2">
                Sign in for Apply
            </div>
        @else
            @php
                $isOwner = optional($job->employer)->user_id === auth()->id();
                $alreadyApplied = $job->hasUserApplied(auth()->user());
            @endphp

            @if ($isOwner)
                <div
                    class="text-center text-sm font-medium text-yellow-600 border-2 border-yellow-700 bg-yellow-100 rounded-md p-3">
                    You cannot apply to your own job.
                </div>
            @elseif ($alreadyApplied)
                <div
                    class="text-center text-sm font-medium text-green-600 border-2 border-green-700 bg-green-100 rounded-md p-3">
                    You already applied to this job.
                </div>
            @else
                <div>
                    <x-link-button
                        class="w-full max-w-xs mx-auto rounded-md border border-green-600 bg-green-50 px-4 py-2.5 text-center text-sm font-semibold text-green-700 shadow-md hover:bg-green-100 hover:text-green-800 transition duration-300"
                        :href="route('job.application.create', $job)">
                        Apply
                    </x-link-button>

                </div>
            @endif
        @endguest


    </x-job-card>

    <x-card class="mb-4 hover:shadow-md transition-shadow duration-300">
        <h2 class="mb-4 text-lg font-semibold text-slate-700">
            More jobs at {{ $job->employer->company_name }}
        </h2>

        <div class="space-y-3">
            @forelse ($job->employer->jobs as $otherjob)
                <div class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 transition">
                    <div>
                        <a href="{{ route('jobs.show', $otherjob) }}"
                            class="block text-sm font-medium text-slate-700 hover:text-blue-600 transition">
                            {{ $otherjob->title }}
                        </a>
                        <span class="text-xs text-slate-400">
                            {{ $otherjob->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <div class="text-sm font-semibold text-emerald-600">
                        ${{ number_format($otherjob->salary) }}
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 italic">Nothing Yet</div>
            @endforelse
        </div>
    </x-card>


</x-layout>
