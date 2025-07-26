<nav {{ $attributes }}>
    <ul class="flex space-x-2 text-slate-500 ">
        <li>
            <a href="/" class="hover:text-cyan-600 transition 300">Home</a>
        </li>
        @foreach ($links as $label => $link)
            <li>➜</li>
            <li>
                <a href="{{ $link }}" class="hover:text-slate-700 transition 300">
                    {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
