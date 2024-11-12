@props(['tab' , 'active'])

<button {{ $attributes }}
        class="hover:text-primary font-medium tracking-wide py-2 transition-all{{ $active == $tab ? ' border-b-2 border-b-primary' : '' }}">
    {{ $tab }}
</button>
