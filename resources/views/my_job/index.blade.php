<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Jobs' => '#']" />

    <div class="mb-8 text-right">
        <x-link-button href="{{ route('my-jobs.create') }}">➕ Add New Job</x-link-button>
    </div>

    @forelse ($jobs as $job)
        <x-job-card :$job>
            <div class="space-y-4 text-sm text-slate-700">
                @forelse ($job->jobApplications as $application)
                    <div class="rounded-lg border border-slate-200 p-4 hover:shadow-sm transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="space-y-1">
                                <div class="text-base font-semibold text-slate-800">
                                    {{ $application->user->name }}
                                </div>
                                <div class="text-xs text-slate-500">
                                    Applied {{ $application->created_at->diffForHumans() }}
                                </div>
                                <a href="#" class="inline-block text-sm text-indigo-600 hover:underline">
                                    Download CV
                                </a>
                            </div>
                            <div class="text-right md:text-left">
                                <div class="text-green-600 font-bold text-sm">
                                    ${{ number_format($application->expected_salary) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500 italic">No applications yet.</div>
                @endforelse
                <div class="flex space-x-2">
                    <x-link-button href="{{route('my-jobs.edit',$job)}}">Edit</x-link-button>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="text-center border-2 border-dashed border-slate-300 rounded-xl p-8 bg-slate-50">
            <div class="text-lg font-semibold text-slate-700 mb-2">No Jobs Yet</div>
            <div class="text-sm text-slate-600">
                Post your first job <a class="text-indigo-600 hover:underline"
                    href="{{ route('my-jobs.create') }}">here</a>!
            </div>
        </div>
    @endforelse
</x-layout>
