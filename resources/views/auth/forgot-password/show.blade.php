<x-layout>
    <h1 class="my-16 text-center text-5xl font-medium text-slate-600">Reset Password</h1>

    <x-card>

        <form action="{{route('password.email')}}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input name="email" class="text-lg py-3 px-4" />
            </div>

            <x-button class="w-full bg-green-50 text-lg py-3 cursor-pointer hover:bg-slate-100">Send Reset Link</x-button>

        </form>
    </x-card>
</x-layout>
