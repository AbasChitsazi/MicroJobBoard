<x-layout>
    <div class="rounded-md border border-dashed border-slate-400 p-8 max-w-md mx-auto mt-20 shadow-sm">
        <div class="text-center text-2xl font-semibold text-slate-700 mb-4">
            404 - Page Not Found
        </div>
        <div class="text-center text-slate-500">
            Oops! The page you’re looking for doesn’t exist.<br>
            Return to <a class="text-indigo-500 hover:underline" href="{{ route('jobs.index') }}">Home</a>.
        </div>
    </div>
</x-layout>
