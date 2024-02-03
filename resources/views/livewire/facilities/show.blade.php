<?php
use App\Models\Facility;
use function Livewire\Volt\{state , layout , mount};

//
    layout('layouts.app');

    state(['facility' ,'tab' => 'Description']);
    

    mount(function($facility){

        $this->facility = Facility::where('slug', $facility)->firstOrFail();
    });

    $changeTab = function($tab)
    {
        $this->tab = $tab;
    }



?>

<div>
    <div class="grid grid-cols-2 border-y-4 border-green-600">
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
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex gap-8 flex-wrap">
                <x-tab-link tab="Description" :active='$tab' wire:click="changeTab('Description')"/>
                <x-tab-link tab="Gallery" :active='$tab' wire:click="changeTab('Gallery')"/>
                <x-tab-link tab="Services" :active='$tab' wire:click="changeTab('Services')"/>
                <x-tab-link tab="Contacts" :active='$tab' wire:click="changeTab('Contacts')"/>
            </div>
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
                <livewire:facilities.save :facility='$facility' />
            </div> 
            @if ($tab == 'Description')
                <livewire:facilities.description :description='$facility->description' />
            @endif
            @if ($tab == 'Services')
                <livewire:facilities.services :facility='$facility' />
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
