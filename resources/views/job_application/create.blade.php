<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" />

    <x-job-card :$job />

    <x-card>
        <h2 class="mb-4 text-lg font-medium">
            <form action="{{ route('job.application.store', $job) }}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="mb-4">
                    <x-label for="expected_salary" :required="true">Expected Salary</x-label>
                    <x-text-input type="number" name="expected_salary" />
                </div>
                <div class="mb-4">
                    <x-label for="cv" :required="true">Upload CV</x-label>
                    <x-text-input class="" type="file" name="cv" />
                </div>
                <x-button class="w-full cursor-pointer text-green-600">
                    Apply
                </x-button>
            </form>
        </h2>
    </x-card>
</x-layout>
