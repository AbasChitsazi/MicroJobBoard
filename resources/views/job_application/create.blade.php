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
                    <x-text-input type="number" name="expected_salary" />
                </div>
                <div class="mb-4">
                    <label for="cv" class="mb-2  block text-base font-normal text-slate-900">Upload CV</label>
                    <x-text-input class="" type="file" name="cv" />
                </div>
                <x-button class="w-full cursor-pointer text-green-600">
                    Apply
                </x-button>
            </form>
        </h2>
    </x-card>
</x-layout>
