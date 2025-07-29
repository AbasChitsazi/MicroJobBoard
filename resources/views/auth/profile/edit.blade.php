<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Profile' => route('auth.profile'), 'Edit' => '#']" />
    <x-card>
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Edit Profile</h2>
            </div>
            <div>
                <div class="text-sm">
                    <span class="font-medium  text-green-600">Last Update:
                        {{ auth()->user()->updated_at->diffForHumans() }}

                    </span>
                </div>
            </div>
        </div>

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
                <div class="mb-8 text-xl font-semibold text-gray-800">
                    Change Password
                </div>
                <div class="mb-8">
                    <x-label for="current_password" >Current Password</x-label>
                    <x-text-input name="current_password" type="password" value="" />
                </div>
                <div class="mb-8">
                    <x-label for="new_password" >New Password</x-label>
                    <x-text-input name="new_password" type="password" value="" />
                </div>
                <div class="mb-8">
                    <x-label for="new_password_confirmation" >Retype New Password</x-label>
                    <x-text-input name="new_password_confirmation" type="password" value="" />
                </div>
                <x-button class="cursor-pointer">Update</x-button>
            </div>
        </form>

    </x-card>
</x-layout>
