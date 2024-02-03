<?php

use App\Models\Service;
use function Livewire\Volt\{state , mount};
    state(['facility']);
?>

<div class="grid gap-12">
    @forelse ($facility->services as $service)
        <livewire:facilities.services.show :service='$service'/>
    @empty
        <div>
            No Services Available
        </div>
    @endforelse
</div>
