<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Jobs' => '#']" />

    <div class="items-center flex justify-between mb-8">
        <div class="text-right">
            <x-link-button href="{{ route('my-jobs.create') }}">➕ Add New Job</x-link-button>
        </div>
        <div>
            <form method="GET" action="{{ route('my-jobs.index') }}">
                <select name="status" onchange="this.form.submit()"
                    class="px-2 py-1 border border-gray-500 rounded-md text-sm text-gray-700 focus:outline-none focus:ring focus:ring-emerald-300">
                    <option value="" {{ request('status') === null ? 'selected' : '' }}>All</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="deleted" {{ request('status') === 'deleted' ? 'selected' : '' }}>Deleted</option>
                </select>
            </form>
        </div>
    </div>

    @forelse ($jobs as $job)
        <x-my-job-card :$job>
            <div class="space-y-4 text-sm text-slate-700">


                @if (!$job->deleted_at)
                    <div class="grid grid-cols-3 gap-2 w-full mt-12">

                        <a href="{{ route('my-jobs.show', $job) }}"
                            class="w-full inline-flex cursor-pointer items-center justify-center gap-2 rounded-md bg-emerald-100 px-4 py-2 text-sm font-medium text-emerald-700 hover:bg-emerald-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>

                            Show CV's
                        </a>
                        <a href="{{ route('my-jobs.edit', $job) }}"
                            class="w-full inline-flex cursor-pointer items-center justify-center gap-2 rounded-md bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            Edit
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('my-jobs.destroy', $job) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick='return confirm("Are you sure to delete {{ $job->title }}")'
                                class="w-full inline-flex cursor-pointer items-center justify-center gap-2 rounded-md bg-red-100 px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16
                                          19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0
                                          1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0
                                          0-3.478-.397m-12 .562c.34-.059.68-.114
                                          1.022-.165m0 0a48.11 48.11 0 0 1
                                          3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964
                                          51.964 0 0 0-3.32 0c-1.18.037-2.09
                                          1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </x-my-job-card>
    @empty
        <div class="text-center border-2 border-dashed border-slate-300  rounded-xl p-8 bg-slate-50">
            <div class="text-lg font-semibold text-slate-700 mb-2">No Jobs Yet</div>
            <div class="text-sm text-slate-600">
                Post your first job <a class="text-indigo-600 hover:underline"
                    href="{{ route('my-jobs.create') }}">here</a>!
            </div>
        </div>
    @endforelse
</x-layout>
