<x-layout>
    <h1 class="my-16 text-center text-5xl font-medium text-slate-600">Reset Your Password</h1>

    <x-card>

        <form action="{{route('password.update')}}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type="password" class="text-lg py-3 px-4" />
            </div>
            <div class="mb-8">
                <x-label for="password_confirmation" :required="true">Retype Passsword</x-label>
                <x-text-input name="password_confirmation" type="password" class="text-lg py-3 px-4" />
            </div>
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <x-button class="w-full bg-green-50 text-lg py-3 cursor-pointer hover:bg-slate-100">Reset</x-button>

        </form>
    </x-card>
</x-layout>
