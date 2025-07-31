<x-admin-component.dashboard>
    <x-admin-component.breadcrumbs class="mb-4" :links="['Users' => route('admin.users'), $user->name => route('admin.show.user', $user), 'Edit' => '#']" />
    <x-card>
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Edit Profile</h2>
            </div>
            <div>
                <div class="text-sm">
                    <span class="font-medium  text-green-600">Last Update:
                        {{ $user->updated_at->diffForHumans() }}

                    </span>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.update.user',$user) }}" method="POST">
            @csrf

            <div class="mt-10">
                <div class="mb-8">
                    <x-label for="name" required="true">Name</x-label>
                    <x-text-input name="name" value="{{ $user->name }}" />
                </div>
                <div class="mb-8">
                    <x-label for="email" required="true">E-mail</x-label>
                    <x-text-input name="email" value="{{ $user->email }}" />
                </div>
                <div class="mb-8 text-xl font-semibold text-gray-800">
                    Change Password
                </div>
                <div class="mb-8">
                    <x-label for="npassword">New Password</x-label>
                    <x-text-input name="password" type="password" value="" />
                </div>
                <div class="mb-8">
                    <x-label for="password_confirmation">Retype New Password</x-label>
                    <x-text-input name="password_confirmation" type="password" value="" />
                </div>
                <x-button class="cursor-pointer">Update</x-button>
            </div>
        </form>

    </x-card>

</x-admin-component.dashboard>
