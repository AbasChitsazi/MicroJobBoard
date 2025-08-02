<x-admin-component.dashboard>
    <x-admin-component.breadcrumbs class="mb-4" :links="['Settings' => route('admin.setting.index')]" />

    <x-card>
        <h2 class="text-xl mb-8">Add New Admin</h2>
        <form action="{{ route('admin.settings.create.admin') }}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="name" :required="true">Name</x-label>
                <x-text-input name="name" class="text-lg py-3 px-4" />
            </div>

            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input name="email" class="text-lg py-3 px-4" />
            </div>

            <div class="mb-8">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type="password" class="text-lg py-3 px-4"/>
            </div>
            <x-button class="w-full bg-green-50 text-lg py-3 cursor-pointer hover:bg-slate-100">Create Admin</x-button>

        </form>
    </x-card>
</x-admin-component.dashboard>
