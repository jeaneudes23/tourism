<?php

use App\Models\Service;
use function Livewire\Volt\{state , mount};
    state(['facility']);
?>

<div class="grid sm:grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-8">
    @forelse ($facility->services as $service)
        <livewire:facilities.services.show :service='$service'/>
    @empty
        <div>
            No Services Available
        </div>
    @endforelse
</div>
