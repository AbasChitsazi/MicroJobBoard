<x-layout>
    <h1 class="my-16 text-center text-5xl font-medium text-slate-600">Sign in to Your account</h1>
    <x-card class="py-12 px-20">
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div class="mb-8">
                <label for="email" class="mb-2 block text-base font-normal text-slate-900">E-mail</label>
                <x-text-input name="email" class="text-lg py-3 px-4" />
            </div>

            <div class="mb-8">
                <label for="password" class="mb-2 block text-base font-normal text-slate-900">Password</label>
                <x-text-input name="password" type="password" class="text-lg py-3 px-4"/>
            </div>

            <div class="mb-8 flex justify-between text-base font-medium">
                <div>
                    <div class="items-center flex space-x-2">
                        <input type="checkbox" name="remember" class="rounded-md border border-slate-400">
                        <label for="remember" class="select-none">Remember me</label>
                    </div>
                </div>
                <div>
                    <a href="#" class="text-indigo-600 hover:underline">Forgot password?</a>
                </div>
            </div>
            <x-button class="w-full bg-green-50 text-lg py-3">Login</x-button>
        </form>
    </x-card>
</x-layout>
