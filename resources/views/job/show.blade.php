<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
    <x-job-card :$job>
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description)) !!}
        </p>
        @guest
            <div class="text-center text-sm font-medium text-red-400 border-2 border-red-400 bg-red-100 rounded-md p-3">
                Sign in for Apply
            </div>
        @else
            @can('apply', $job)
                <x-link-button :href="route('job.application.create', $job)">
                    Apply
                </x-link-button>
            @else
                <div
                    class="text-center text-sm font-medium text-green-600 border-2 border-green-700 bg-green-100 rounded-md p-3">
                    <div class="flex items-center justify-center gap-2">
                        <span>You Already Applied to this job</span>
                    </div>
                    @if ($job->user_application)
                        {{ $job->user_application->created_at->diffForHumans() }}
                    @endif
                </div>
            @endcan
        @endguest
    </x-job-card>

    <x-card class="mb-4 hover:shadow-lg transition-shadow duration-300">
        <h2 class="mb-4 text-lg font-medium">
            More {{ $job->employer->company_name }} Jobs
        </h2>
        <div class="text-m text-slate-500">
            @foreach ($job->employer->jobs as $otherjob)
                <div class="mb-4 flex justify-between  hover:text-blue-950 transition 300">
                    <div>
                        <div class="text-slate-700">
                            <a href="{{ route('jobs.show', $otherjob) }}">{{ $otherjob->title }}</a>
                        </div>
                        <div class="text-xs">
                            {{ $otherjob->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="text-sm">${{ number_format($otherjob->salary) }}</div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>
