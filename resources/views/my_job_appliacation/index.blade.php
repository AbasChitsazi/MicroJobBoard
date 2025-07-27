<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Job Applications' => '#']" />

    @forelse ($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex justify-between items-center text-sm text-slate-600 bg-gray-50 rounded-md p-4 shadow-sm">
                <div class="space-y-1">
                    <div class="font-semibold text-gray-800">
                        Applied {{ $application->created_at->diffForHumans() }}
                    </div>

                    <div>
                        <span class="font-medium text-gray-700">Other
                            {{ Str::plural('applicant', $application->job->job_applications_count - 1) }}:</span>
                        {{ $application->job->job_applications_count - 1 }}
                    </div>

                    <div>
                        <span class="font-medium text-gray-700">Your Asking Salary:</span>
                        <span
                            class="text-green-500 font-semibold">${{ number_format($application->expected_salary) }}</span>
                    </div>

                    <div>
                        <span class="font-medium text-gray-700">Average Asking Salary:</span>
                        <span
                            class="text-blue-500 font-semibold">${{ number_format($application->job->job_applications_avg_expected_salary) }}</span>
                    </div>
                </div>
                @if (!$application->job->deleted_at)
                <div class="text-right text-red-500 ">
                    <form action="{{ route('my-job-applications.destroy', $application) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button onclick="return confirm('Are you sure you want to cancle applicants {{$application->job->title}}?');"  class="cursor-pointer">Cancle</x-button>
                    </form>
                </div>
            </div>
            @endif

        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-400 p-8">
            <div class="text-center font-medium">
                No job applictions yet
            </div>
            <div class="text-center">
                Go find some jobs <a class="text-indigo-500 hover:underline" href="{{ route('jobs.index') }}">here!</a>
            </div>
        </div>
    @endforelse

</x-layout>
