<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Profile' => route('auth.profile'), 'Edit Company' => '#']" />
    <x-card>
        <h2 class="text-xl font-semibold text-gray-800">Edit Profile</h2>
        <form action="{{ route('auth.company.update') }}" method="POST">
            @csrf
            <div class="mt-10">
                <div class="mb-8">
                    <x-label for="company_name" required="true">Company Name</x-label>
                    <x-text-input name="company_name" value="{{ auth()->user()->employer->company_name }}" />
                </div>
                <x-button class="cursor-pointer">Update</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
