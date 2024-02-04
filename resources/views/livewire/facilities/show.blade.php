<?php
use App\Models\Facility;
use function Livewire\Volt\{state , layout , mount};

//
    layout('layouts.actions');

    state(['facility']);
    state(['tab' => 'Home'])->url();
    

    mount(function($facility){

        $this->facility = Facility::where('slug', $facility)->firstOrFail();
    });

    $changeTab = function($tab)
    {
        $this->tab = $tab;
    }



?>
<x-slot name='title'>{{$this->facility->name}}</x-slot>
<div>
    <div class="grid grid-cols-2 border-b-4 border-green-600">
        <div class="">
            <img class="w-full h-full object-cover" src={{asset('/storage/'.$facility->image)}} alt="">
        </div>
        <div class="bg-white grid content-center px-4">
            <div class="-translate-x-16 bg-white p-12">
                <div>

                    <p>{{$facility->category->name}}</p>
                    <x-location-pill location="{{ $facility->location }}" />
                </div>
                <h1 class="text-4xl lg:text-5xl  font-bold tracking-wider">
                    {{$facility->name}}
                </h1>
                <p class=" max-w-screen-md font-medium tracking-wide md:text-lg">{{$facility->title}}</p>
    
            </div>
        </div>
    </div>
    <section class=" bg-white">
        <div class="max-w-7xl flex justify-between mx-auto px-4 py-4">
            <div class="flex gap-8 flex-wrap">
                <x-tab-link tab="Home" :active='$tab' wire:click="changeTab('Home')"/>
                <x-tab-link tab="Gallery" :active='$tab' wire:click="changeTab('Gallery')"/>
                <x-tab-link tab="Services" :active='$tab' wire:click="changeTab('Services')"/>
                <x-tab-link tab="Contacts" :active='$tab' wire:click="changeTab('Contacts')"/>
            </div>
            @if (auth()->user() && auth()->user()->has_facility)
            <a class="shrink-0 self-center bg-green-600 rounded-md" target="_blank" href="{{route('filament.facility.tenant', ['tenant' => auth()->user()->facilities()->first()->slug])}}">
                <span class="text-white inline-flex gap-2 items-center font-medium tracking-wide px-4 py-2 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                      </svg>
                    <span>
                        {{ auth()->user()->facilities()->first()->name }}
                    </span>                      
                </span>    
            </a>
            @endif
        </div>
    </section>
    <div wire:loading.flex class="absolute w-full h-2 justify-between overflow-hidden">
        <div class="w-1/4 h-full bg-green-600 animate-ping"></div>
        <div class="w-1/4 h-full bg-green-600 animate-ping"></div>
        <div class="w-1/4 h-full bg-green-600 animate-ping"></div>
    </div>
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4">     
            <div class="mb-8 flex gap-12 items-center">
                <div class="inline-flex items-center gap-2">
                    <img src="{{asset('/storage/'.$facility->category->image)}}" class="w-20 aspect-square object-cover rounded-full" alt="">
                    <div>
                        <span class="text-sm font-medium text-gray-500">{{$facility->category->name}}</span>
                        <h3 class="text-xl font-semibold">{{$facility->name}}</h3>
                    </div>
                </div>
                @if (auth()->check())
                    <livewire:facilities.save :facility='$facility' />
                @endif
            </div> 
            @if ($tab == 'Home')
                <livewire:facilities.description :description='$facility->description' />
            @endif
            @if ($tab == 'Services')
                <livewire:facilities.services.index :facility='$facility' />
            @endif
            @if ($tab == 'Gallery')
                <livewire:facilities.gallery :facility='$facility' />
            @endif
            @if ($tab == 'Contacts')
                <div class="prose">
                    {!!$facility->google_maps !!}
                </div>
            @endif
        </div>
    </section>
</div>
