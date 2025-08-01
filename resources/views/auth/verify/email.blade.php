<x-layout>
    @if (!empty($success))
           <div role="alert"
               class="my-6 rounded-md border-l-4 border-green-400 bg-green-100 p-4 text-green-700 shadow-sm transition">
               <p class="font-bold">✅ Success</p>
               <p>{{ $success }}</p>
           </div>
       @endif
    <x-card>
        <h2 class="text-center text-2xl  mb-10">Enter the code sent to your email</h2>
        <div>
            <form action="">
                <x-text-input class="w-15"  name='code' placeholder="Enter Code ..." value="" ></x-text-input>
                <x-button class="w-full mt-5 cursor-pointer" type="submit" :href="route('admin.dashboard')">Send</x-button>
            </form>
        </div>

    </x-card>
</x-layout>
