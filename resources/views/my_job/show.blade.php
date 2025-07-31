<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Jobs' => route('my-jobs.index'), $job->title => '#']" />


    <x-job-card :job="$job">
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description)) !!}
        </p>
    </x-job-card>

    <x-card class="mt-10 hover:shadow-md transition 300">
        <div class="mb-4 mt-2 font-medium text-2xl ">
            JobSeekers CVs
        </div>
        @forelse ($job->jobApplications as $application)
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 hover:shadow transition mt-4">
                <div class="flex flex-col gap-3">

                    {{-- Header --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-base font-semibold text-slate-700">
                                {{ $application->user->name }}
                            </div>
                            <div class="text-xs text-slate-400">
                                Applied {{ $application->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="text-emerald-600 font-semibold text-sm">
                            ${{ number_format($application->expected_salary) }}
                        </div>
                    </div>

                    {{-- Actions --}}
                    @if (!$job->deleted_at)
                        <div class="flex items-center justify-between" data-id="{{ $application->id }}">
                            {{-- Download Button --}}
                            <a href="{{ route('download-cv', $application) }}"
                                class="px-4 py-1.5 text-sm bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition">
                                Download CV
                            </a>

                            {{-- Status Buttons --}}
                            <div class="flex items-center gap-2 statusForm">
                                @if (is_null($application->is_approved))
                                    <button type="button"
                                        class="approveBtn px-3 py-1 text-sm cursor-pointer bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 transition"
                                        value="1" data-job="{{ $application->id }}">
                                        Approve
                                    </button>
                                    <button type="button"
                                        class="declineBtn px-3 py-1 text-sm cursor-pointer bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition"
                                        value="0" data-job="{{ $application->id }}">
                                        Decline
                                    </button>
                                @elseif ($application->is_approved == 1)
                                    <span
                                        class="px-3 py-1 text-sm font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg">
                                        Approved
                                    </span>
                                @elseif ($application->is_approved == 0)
                                    <span
                                        class="px-3 py-1 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg">
                                        Declined
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-gray-400 italic">No applications yet.</div>
        @endforelse


    </x-card>
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
                            "<span class='px-3 py-1 text-sm font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg'>Approved</span>");
                    } else {
                        statusDiv.html(
                            "<span class='px-3 py-1 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg'>Declined</span>");
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
