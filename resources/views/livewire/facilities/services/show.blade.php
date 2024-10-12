<?php

use App\Models\Service;
use Livewire\Volt\Component;

new class extends Component {
    public Service $service;
}; ?>

<div class="grid shadow rounded-md">
    @if ($service->image)
        <div class="border-b">
            <img class="w-auto mx-auto max-h-64 object-contain" src="{{ '/storage/' . $service->image }}" alt="">
        </div>
    @endif
    <div class="p-6 space-y-3">
        <h4 class="text-xl font-semibold capitalize">{{ $service->name }}</h4>
        <div class="prose max-w-screen-md">{!! $service->description !!}</div>
        @if ($service->is_bookable)
            <div class="flex gap-12 items-center">
                <p class="text-lg border-b-2 py-2 border-primary"><span
                        class="font-semibold">{{ $service->unit_price }}</span> {{ $service->currency }}/
                    {{ $service->unit }}</p>
                @auth
                    <livewire:facilities.services.book-action :service='$service' />
                @endauth

            </div>
        @endif
    </div>
</div>
