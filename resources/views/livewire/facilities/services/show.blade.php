<?php

use App\Models\Service;
use Livewire\Volt\Component;

new class extends Component {
    public Service $service;
}; ?>

<div class="grid grid-cols-[1fr,2fr] border-2 rounded-md">
    <div class="">
        @if ($service->image)   
            <img class="w-full h-full rounded-l-md object-cover" src="{{'/storage/'.$service->image}}" alt="">
        @else
            <div class="w-full h-full grid place-content-center bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                  </svg>
            </div>
        @endif
    </div>
    <div class="p-6">
        <div class="inline-flex gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                </svg>    
                <h4 class="text-xl font-semibold">{{$service->name}}</h4>
        </div>
        <div class="prose max-w-screen-md my-4">{!!$service->description!!}</div>
        @if ($service->is_bookable)
            <div class="flex gap-12 items-center">
                <p class="text-lg border-b-2 py-2 border-green-600"><span class="font-semibold">{{$service->unit_price}}</span> RWF/ {{$service->unit}}</p>
                @auth
                    <livewire:facilities.services.book-action :service='$service' />
                @endauth
                
            </div>
        @endif
    </div>
</div>
