<?php

use function Livewire\Volt\{layout, state};

//
    layout('layouts.app');
    state(['tab' => 'bookings'])->url();

    $tabber = function($tab){
        $this->tab = $tab;
    }

?>

<div class="grid gap-6 lg:grid-cols-[300px,1fr] items-start container">
    <div class="grid gap-2 py-8 content-start lg:sticky lg:top-16">
        @if (auth()->user()->role == 'manager')
        <button wire:click="tabber('facilities')" class="px-4 justify-start flex gap-1 py-2 rounded-md font-medium text-sm tracking-wide transition-all {{$tab == 'facilities' ? 'bg-primary/10 text-primary' : 'hover:bg-gray-100' }}"><x-heroicon-s-building-office class="size-5"/>Facilities</button>
        @endif
        <button wire:click="tabber('bookings')" class="px-4 justify-start flex gap-1 py-2 rounded-md font-medium text-sm tracking-wide transition-all {{$tab == 'bookings' ? 'bg-primary/10 text-primary' : 'hover:bg-gray-100' }}"><x-heroicon-o-bookmark-square class="size-5"/>Bookings</button>
        <button wire:click="tabber('bookmarks')" class="px-4 justify-start flex gap-1 py-2 rounded-md font-medium text-sm tracking-wide transition-all {{$tab == 'bookmarks' ? 'bg-primary/10 text-primary' : 'hover:bg-gray-100' }}"><x-heroicon-o-star class="size-5"/>Bookmarks</button>
    </div>
    <section class="lg:pl-6 py-8 lg:border-l">
        <x-loader-fw />
        @if ($tab == 'bookings')
            <livewire:myspace.bookings />
        @endif
        @if ($tab == 'bookmarks')
         <livewire:myspace.bookmarks />
        @endif
        @if ($tab == 'facilities')
         <livewire:myspace.facilities />
        @endif
    </section>
</div>
