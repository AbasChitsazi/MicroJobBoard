<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Profile' => route('auth.profile'), 'Edit' => '#']" />
    <x-card>
        <h2 class="text-xl font-semibold text-gray-800">Edit Profile</h2>
        <form action="{{ route('auth.profile.update') }}" method="POST">
            @csrf
            <div class="mt-10">
                <div class="mb-8">
                    <x-label for="name" required="true">Name</x-label>
                    <x-text-input name="name" value="{{ auth()->user()->name }}" />
                </div>
                <div class="mb-8">
                    <x-label for="email" required="true">E-mail</x-label>
                    <x-text-input name="email" value="{{ auth()->user()->email }}" />
                </div>
                <x-button class="cursor-pointer">Update</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
