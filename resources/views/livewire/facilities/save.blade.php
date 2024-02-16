<?php

use function Livewire\Volt\{state,mount};

    state(['facility' , 'status' => 0]);

    mount(function(){
        if (auth()->check())
            $this->status = auth()->user()->bookmarks()->where('facility_id',$this->facility->id)->exists();
    });

    $save = function()
    {
        if (!auth()->check())
            return redirect()->route('login');
        
        auth()->user()->bookmarks()->toggle($this->facility);
        $this->status = !$this->status;
    }
?>

<div>
    <Button wire:click="save" class="border w-32 h-12 rounded-md hover:bg-gray-100 transition-all">
        <span  wire:loading.remove class="flex justify-center items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 {{$status ? 'fill-green-600 stroke-green-600' : ''}}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
            </svg>  
            <span class="font-medium tracking-wide">Bookmark</span>
        </span>
        <div wire:loading.flex class="flex items-center justify-center">
            <div class="w-6 aspect-square border-4 border-green-600 border-l-transparent animate-spin rounded-full"></div>
        </div>
        
                         
    </Button>
</div>
