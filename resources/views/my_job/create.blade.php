<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Jobs' => route('my-jobs.index'), 'Create' => '#']"  />
    <x-card class="mb-8">
        <form action="{{ route('my-jobs.store') }}" method="POST">
            @csrf
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">Job Title</x-label>
                    <x-text-input name="title" />
                </div>
                <div>
                    <x-label for="location" :required="true">Location</x-label>
                    <x-text-input name="location" />
                </div>
                <div class="col-span-2">
                    <x-label for="salary" :required="true">Salary</x-label>
                    <x-text-input name="salary" />
                </div>
                <div class="col-span-2">
                    <x-label for="description" :required="true">Description</x-label>
                    <x-text-input name="description" type="textarea" />
                </div>
                <div>
                    <x-label for="experience" :required="true">Experience</x-label>

                    <x-radio-group name="experience" :options="\App\Models\Job::$experience" :alloption="false"  :value="old('experience')"/>
                </div>
                                <div>
                    <x-label for="category" :required="true">Category</x-label>

                    <x-radio-group name="category" :options="\App\Models\Job::$jobcategory" :alloption="false" :value="old('category')"/>
                </div>
            </div>
            <div class="col-span-2">
                <x-button class="w-full cursor-pointer ">Create Job</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
