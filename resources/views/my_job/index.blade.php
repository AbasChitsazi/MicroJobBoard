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
        <x-job-card :$job>
            <div class="space-y-4 text-sm text-slate-700">
                @forelse ($job->jobApplications as $application)
                    <div class="rounded-lg border border-slate-200 p-4 hover:shadow-sm transition">
                        <div class="flex flex-col gap-4">

                            <div class="flex items-center justify-between">
                                <div class="text-base font-semibold text-slate-800">
                                    {{ $application->user->name }}
                                </div>
                                <div class="text-xs text-slate-500">
                                    Applied {{ $application->created_at->diffForHumans() }}
                                </div>
                            </div>


                            <div class="text-green-600 font-bold text-lg">
                                ${{ number_format($application->expected_salary) }}
                            </div>

                            @if (!$job->deleted_at)
                            <div class="flex items-center justify-between " data-id="{{ $application->id }}">
                                <a href="{{ route('download-cv', $application) }}"
                                    class="px-3 py-1 text-sm bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition">
                                    Download CV
                                </a>

                                <div class="flex space-x-2 statusForm">
                                    @if (is_null($application->is_approved))
                                        <button type="button"
                                            class="approveBtn px-3 py-1 text-sm cursor-pointer bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition"
                                            value="1" data-job="{{ $application->id }}">
                                            Approve
                                        </button>
                                        <button type="button"
                                            class="declineBtn px-3 py-1 text-sm cursor-pointer bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
                                            value="0" data-job="{{ $application->id }}">
                                            Decline
                                        </button>
                                    @elseif ($application->is_approved == 1)
                                        <div class="font-bold bg-white text-emerald-500">Approved</div>
                                    @elseif ($application->is_approved == 0)
                                        <div class="font-bold bg-white text-red-500">Declined</div>
                                    @endif
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="text-gray-500 italic">No applications yet.</div>
                @endforelse


                @if (!$job->deleted_at)
                    <div class="grid grid-cols-2 gap-2 w-full mt-4">

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
        </x-job-card>
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
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.approveBtn, .declineBtn', function(e) {
        e.preventDefault();

        var is_approved = $(this).val();
        var jobid = $(this).data('job');
        var statusDiv = $(this).closest('.statusForm');
        var clickedButton = $(this);

        var originalText = clickedButton.text();
        var originalOpacity = clickedButton.css('opacity');

        clickedButton.prop('disabled', true);
        clickedButton.css('opacity', '0.6');
        clickedButton.text('Processing...');

        $.ajax({
            url: "{{ route('myjobs-status') }}",
            type: "POST",
            data: {
                status: is_approved,
                jobs: jobid
            },
            success: function(response) {

                if (response.status === true) {
                    if (parseInt(response.message) === 1) {
                        statusDiv.html(
                            "<div class='font-bold bg-white text-emerald-500'>Approved</div>");
                    } else {
                        statusDiv.html(
                            "<div class='font-bold bg-white text-red-500'>Declined</div>");
                    }
                } else {

                    clickedButton.prop('disabled', false);
                    clickedButton.css('opacity', originalOpacity);
                    clickedButton.text(originalText);
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                clickedButton.prop('disabled', false);
                clickedButton.css('opacity', originalOpacity);
                clickedButton.text(originalText);
            }
        });
    });
</script>
