<?php

use App\Models\Service;
use Livewire\Volt\Component;

new class extends Component {
    public Service $service;
}; ?>

<div class="grid rounded-md shadow">
  @if ($service->image)
    <div class="border-b">
      <img class="aspect-video object-cover" src="{{ '/storage/' . $service->image }}" alt="">
    </div>
  @endif
  <div class="space-y-3 p-6">
    <h4 class="text-xl font-semibold capitalize">{{ $service->name }}</h4>
    <div class="prose max-w-screen-md">{!! $service->description !!}</div>
    @if ($service->is_bookable)
      <div class="flex items-center gap-12">
        <p class="border-b-2 border-primary py-2 text-lg">
          <span class="font-semibold">{{ number_format($service->unit_price,2)}}</span> {{ $service->currency }}/{{ $service->unit }}
        </p>
        @auth
          <livewire:facilities.services.book-action :service='$service' />
        @endauth

      </div>
    @endif
  </div>
</div>
