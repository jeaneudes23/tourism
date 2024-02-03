<?php

use App\Models\Photo;
use function Livewire\Volt\{state , mount};
    state(['facility']);
?>

<div class="grid gap-8 grid-cols-[repeat(auto-fill,minmax(250px,1fr))]">
    @forelse ($facility->photos as $photo)
        <div class="grid gap-2">
            <div>
                <img src="{{asset('/storage/'.$photo->url)}}" alt="">
            </div>
            <div>
               <span class="font-medium">Description: </span> {{$photo->description}}
            </div>
        </div>
    @empty
        <p>No Photos</p>
    @endforelse
</div>
