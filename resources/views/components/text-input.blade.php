<div class="relative">
    @if ('textarea' != $type)
        @if ($formRef && $value)
            <button type="button" class="absolute top-0 right-0 flex h-full items-center pr-2"
                @click="$refs['input-{{ $name }}'].value = '';$refs['{{ $formRef }}'].submit(); ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-5 w-5 text-slate-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
        <input x-ref="input-{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
            name="{{ $name }}" value="{{ old($name, $value) }}" id="{{ $name }}"
            @class([
                'w-full rounded-md border-0 py-2 px-3 text-sm ring-2 placeholder:text-slate-400 focus:ring-3',
                'pr-8' => $formRef,
                'file:mr-4 file:py-1 file:px-3',
                'file:rounded-md file:border-0',
                'file:text-sm file:font-semibold',
                'file:bg-indigo-50 file:text-indigo-700',
                'hover:file:bg-indigo-100',
                'ring-slate-300' => !$errors->has($name),
                'ring-red-300' => $errors->has($name),
            ]) />
    @else
        <textarea @class([
            'w-full  rounded-md border-0  py-1.5 px-3 text-sm ring-2 placeholder:text-slate-400 focus:ring-3',
            'pr-8' => $formRef,
            'ring-slate-300' => !$errors->has($name),
            'ring-red-300' => $errors->has($name),
        ])  name="{{ $name }}"
            id="{{ $name }}">{{ old($name, $value) }}</textarea>
    @endif
    @error($name)
        <div class="mt-1 text-sm text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>

