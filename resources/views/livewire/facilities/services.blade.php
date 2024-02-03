<?php

use App\Models\Service;
use function Livewire\Volt\{state , mount};
    state(['facility']);
?>

<div>
    //
    {{$facility->services}}
</div>
