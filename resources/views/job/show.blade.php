<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
    <x-job-card :$job>
    <p class="text-sm text-slate-500 mb-4">
        {!! nl2br(e($job->description)) !!}
    </p>
    </x-job-card>

    <x-card class="mb-4 hover:shadow-lg transition-shadow duration-300">
        <h2 class="mb-4 text-lg font-medium" >
            More {{$job->employer->company_name}} Jobs
        </h2>
        <div class="text-m text-slate-500">
            @foreach ($job->employer->jobs as $otherjob)
            <div class="mb-4 flex justify-between  hover:text-blue-950 transition 300">
                <div >
                    <div class="text-slate-700" >
                        <a  href="{{route('jobs.show',$otherjob)}}">{{$otherjob->title}}</a>
                    </div>
                    <div class="text-xs" >
                        {{$otherjob->created_at->diffForHumans()}}
                    </div>
                </div>
                <div class="text-sm">${{number_format($otherjob->salary)}}</div>
            </div>
            @endforeach
        </div>
    </x-card>
</x-layout>
