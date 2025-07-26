<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Job Applications' => '#']"/>


    @foreach ($applications as $application)
    <x-job-card :job="$application->job"></x-job-card>
@endforeach
</x-layout>
