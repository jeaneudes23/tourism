<?php

use function Livewire\Volt\{state};

    state(['description'])

?>

<div>
    <div class="prose max-w-screen-lg">{!! $description !!}</div>
</div>
