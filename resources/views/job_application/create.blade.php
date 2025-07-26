<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" />

    <x-job-card :$job />

    <x-card>
        <h2 class="mb-4 text-lg font-medium">
            <form action="{{ route('job.application.store', $job) }}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="mb-4">
                    <label for="expected_salary" class="mb-2 block text-base font-normal text-slate-900">Expected
                        Salary</label>
                    <x-text-input class="py-2.5" type="number" name="expected_salary" />
                </div>
                <div class="mb-4">
                    <label for="cv" class="mb-2  block text-base font-normal text-slate-900">Upload CV</label>
                    <x-text-input
                        class="text-gray-500 file:mr-2 file:py-1.5 file:px-4 file:rounded file:border-0 file:text-sm file:font-semiboldfile:bg-indigo-50 file:text-indigo-700 file:bg-indigo-100"
                        type="file" name="cv" />

                </div>
                <x-button class="w-full cursor-pointer text-green-600">
                    Apply
                </x-button>
            </form>
        </h2>
    </x-card>
</x-layout>
