<?php

use function Livewire\Volt\{layout, state};

//
    layout('layouts.app');
    state(['tab' => 'bookings'])->url();

    $tabber = function($tab){
        $this->tab = $tab;
    }

?>

<div>
    <div class="flex justify-center items-center gap-8 my-8">
        <button wire:click="tabber('facilities')" class="px-6 h-10 rounded-md font-medium text-sm tracking-wide transition-all {{$tab == 'facilities' ? 'bg-primary/10 text-primary' : 'hover:bg-gray-100' }}">Facilities</button>
        <button wire:click="tabber('bookings')" class="px-6 h-10 rounded-md font-medium text-sm tracking-wide transition-all {{$tab == 'bookings' ? 'bg-primary/10 text-primary' : 'hover:bg-gray-100' }}">Bookings</button>
        <button wire:click="tabber('bookmarks')" class="px-6 h-10 rounded-md font-medium text-sm tracking-wide transition-all {{$tab == 'bookmarks' ? 'bg-primary/10 text-primary' : 'hover:bg-gray-100' }}">Bookmarks</button>
    </div>
    <section class="max-w-7xl mx-auto px-4">
        <div class="relative">
            <div wire:loading.flex class="absolute w-full h-2 justify-between overflow-hidden">
                <div class="w-1/4 h-full bg-primary animate-ping"></div>
                <div class="w-1/4 h-full bg-primary animate-ping"></div>
                <div class="w-1/4 h-full bg-primary animate-ping"></div>
            </div>
        </div>
        
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
