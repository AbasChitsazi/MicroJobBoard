<x-layout>
    <h1 class="my-16 text-center text-5xl font-medium text-slate-600">Sign up for an account</h1>
<x-card class="py-12 px-20">
        <form action="{{ route('auth.register.store') }}" method="POST">
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

            <div class="mb-8">
                <x-label for="password_confirmation" :required="true">Retype Password</x-label>
                <x-text-input name="password_confirmation" type="password" class="text-lg py-3 px-4"/>
            </div>


            <x-button class="w-full bg-green-50 text-lg py-3 cursor-pointer hover:bg-slate-100">Register</x-button>

        </form>
        <div class="mt-5 text-center">
        Already hava account? <a class="hover:underline text-indigo-500 " href="{{route('login')}}">Sign in</a>
        </div>
    </x-card>
</x-layout>
