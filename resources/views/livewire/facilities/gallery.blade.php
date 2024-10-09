<?php

use App\Models\Photo;
use function Livewire\Volt\{state , mount};
    state(['facility']);
?>

<div class="grid gap-8 grid-cols-[repeat(auto-fill,minmax(300px,1fr))]">
    @forelse ($facility->photos as $photo)
        <div class="grid content-start">
            <div class="col-start-1 row-start-1">
                <img class="w-full aspect-video object-cover" src="{{asset('/storage/'.$photo->url)}}" alt="">
            </div>
            <div class="col-start-1 row-start-1  grid content-end p-2 pl-4 transition-all duration-500 group hover:bg-black/50">
               <span class="text-white text-sm opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">{{$photo->description}} </span> 
               
            </div>
        </div>
    @empty
        <p>No Photos</p>
    @endforelse
</div>
