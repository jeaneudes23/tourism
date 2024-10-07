<?php

use function Livewire\Volt\{state};

    state(['service' ,'booking' => false]);

    $showHideBooking = function(){
        $this->booking = !$this->booking;
    }

?>

<div class="grid grid-cols-[300px,auto] border-2 rounded-md">
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
    <div>
       <div class="px-2 py-2 {{$booking ? 'absolute right-0 -translate-x-full' : 'hidden'}}">
            <button wire:click='showHideBooking()' class="p-2 rounded-full text-white bg-red-600 hover:bg-red-800 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                  </svg>                      
            </button>
       </div>
       <div wire:loading.flex class="h-full justify-center items-center w-full">
            <div class="w-10 border-4 rounded-full aspect-square border-l-transparent animate-spin border-primary"></div>
        </div>
       <div class="p-6">
        @if (!$booking)
        <div wire:loading.remove>
            <div class="inline-flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                  </svg>    
                  <h4 class="text-xl font-semibold">{{$service->name}}</h4>
            </div>
            <div class="prose max-w-screen-md my-4">{!!$service->description!!}</div>
            @if ($service->is_bookable)
                <div class="flex gap-12 items-center">
                    <p class="text-lg border-b-2 py-2 border-primary"><span class="font-semibold">{{$service->unit_price}}</span> RWF/ {{$service->unit}}</p>
                    @auth
                        <button wire:click='showHideBooking()' class="px-4 py-2 bg-primary rounded-md text-white font-medium tracking-wide">
                            {{$service->custom_text}}
                        </button>
                    @endauth
                    
                </div>
            @endif
        </div>
        @else
        <div wire:loading.remove>
            <livewire:facilities.services.book-service :service='$service' />
        </div>
        @endif
       </div>
        
    </div>
</div>
