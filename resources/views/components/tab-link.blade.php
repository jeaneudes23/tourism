@props(['tab' , 'active'])

<button {{ $attributes }}
        class="hover:text-green-600 font-medium tracking-wide p-2 transition-all{{ $active == $tab ? ' border-b-2 border-b-green-600' : '' }}">
    {{ $tab }}
</button>
