<x-adminComponent.layout>
    <h1 class="my-16 text-center text-5xl font-medium text-slate-600">Sign in to Your Panel</h1>
    <x-card>
        <form action="{{ route('admin.panel.login') }}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input name="email" class="text-lg py-3 px-4" />
            </div>

            <div class="mb-8">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type="password" class="text-lg py-3 px-4"/>
            </div>

            <div class="mb-8 flex justify-between text-base font-medium">
                <div>
                    <div class="items-center flex space-x-2">
                        <input type="checkbox" name="remember" class="rounded-md border border-slate-400">
                        <label for="remember" class="select-none">Remember me</label>
                    </div>
                </div>
            </div>
            <x-button class="w-full bg-green-50 text-lg py-3 cursor-pointer hover:bg-slate-100">Login</x-button>

        </form>
    </x-card>
</x-adminComponent.layout>
