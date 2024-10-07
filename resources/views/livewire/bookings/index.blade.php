<?php

use App\Models\Booking;

use function Livewire\Volt\{with, usesPagination, layout, state};

    usesPagination();
    layout('layouts.app');

    state(['query' => ''])->url();

    $filter = function($query)
    {
        $this->query = $query;
    };

    with(fn () => ['bookings' =>Booking::where('customer_id', auth()->user()->id)->where('status', 'like' , '%'.$this->query.'%')->latest()->paginate(10)]);

?>
<x-slot name='title'>Bookings</x-slot>
<div class="max-w-7xl mx-auto px-4 py-16">
    
    <div class="flex gap-8">
        <div class="relative grow grid gap-4">
            <div wire:loading.flex class="absolute w-full h-2 justify-between overflow-hidden">
            <div class="w-1/4 h-full bg-primary animate-ping"></div>
            <div class="w-1/4 h-full bg-primary animate-ping"></div>
            <div class="w-1/4 h-full bg-primary animate-ping"></div>
        </div>
            @forelse($bookings as $booking)
            <div class="grid grid-cols-[1fr,3fr]">
                <div>
                    @if ($booking->service->image)
                    <img class="w-full  h-full rounded-l-md object-cover" src="{{'/storage/'.$booking->service->image}}" alt="">
                    @else
                    <div class="w-full h-full grid rounded-l-md place-content-center bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-4 border-2 rounded-r-lg grid gap-2">
                    <div class="grid gap-1">
                        <div class="flex items-center justify-between">
                            <a class="hover:text-primary transition-all" href="{{route('facilities.show' , $booking->facility->slug)}}"><span class="font-medium">Facility: </span>{{$booking->facility->name}}</a>
                            <div class="bg-gray-100 font-medium shadow px-4 h-10 flex items-center justify-center rounded-full">
                                <span class="sr-only">Status: </span> <span>{{$booking->status}}</span>
                            </div>
                        </div>
                        <div><span class="font-medium">Service: </span> {{$booking->service->name}} (x{{$booking->quantity}} {{\Illuminate\Support\Str::plural($booking->service->unit)}}) on {{$booking->booking_date}}</div>
                        <div><span class="font-medium">Total: </span> <span>{{$booking->total_price}}</span><span> RWF</span></div>
                        @if ($booking->manager_message)
                        <p class="">
                            <span class="inline-flex gap-1 translate-y-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-45">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                                <span class="font-medium">Manager:</span>
                            </span>
                            {{$booking->manager_message}}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div>
                No Bookings Found
            </div>
            @endforelse
            <div class="mt-5">
                {{ $bookings->links() }}
            </div>
        </div>
        <div class="w-64 shrink-0 self-start p-4 rounded-md border">
            <div class="grid gap-2">
                <button wire:click="filter('')" class="px-4 py-2 bg-gray-200">
                    all
                </button>
                <button wire:click="filter('cancelled')" class="px-4 py-2 bg-gray-200">
                    cancelled
                </button>
                <button wire:click="filter('pending')" class="px-4 py-2 bg-gray-200">
                    pending
                </button>
                <button wire:click="filter('confirmed')" class="px-4 py-2 bg-gray-200">
                    confirmed
                </button>
            </div>
        </div>
    </div>


</div>