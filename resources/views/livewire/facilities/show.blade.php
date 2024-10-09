<?php
use App\Models\Facility;
use function Livewire\Volt\{state, layout, mount};

//
layout('layouts.app');

state(['facility']);
state(['tab' => 'Home'])->url();

mount(function ($facility) {
    $this->facility = Facility::where('slug', $facility)->firstOrFail();
});

$changeTab = function ($tab) {
    $this->tab = $tab;
};

?>
<x-slot name='title'>{{ $this->facility->name }}</x-slot>
<div class="-mt-16">
    <div class="grid grid-cols-2 border-b-4 border-primary">
        <div class="xl:h-dvh">
            <img class="w-full h-full object-cover" src={{ asset('/storage/' . $facility->image) }} alt="">
        </div>
        <div class="grid content-center px-8">
            <h1 class="text-4xl lg:text-5xl  font-bold tracking-wider">
                {{ $facility->name }}
            </h1>
            <p class=" max-w-screen-md font-medium tracking-wide md:text-lg">{{ $facility->title }}</p>
        </div>
    </div>
    <div class="container max-w-7xl">
        <div class="py-4">
            <div class="flex justify-between">
                <div class="flex gap-8 flex-wrap">
                    <x-tab-link tab="Home" :active='$tab' wire:click="changeTab('Home')" />
                    <x-tab-link tab="Gallery" :active='$tab' wire:click="changeTab('Gallery')" />
                    <x-tab-link tab="Services" :active='$tab' wire:click="changeTab('Services')" />
                    <x-tab-link tab="Contacts" :active='$tab' wire:click="changeTab('Contacts')" />
                </div>
                <div class="flex items-center gap-2">
                    @if (auth()->check())
                        <livewire:facilities.save :facility='$facility' />
                    @endif
                </div>
            </div>
        </div>
        <div class="flex gap-12 items-center justify-between">

        </div>
        <x-loader-fw />
        <div class="py-12">
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
                <livewire:facilities.contacts :facility='$facility' />
            @endif
        </div>
    </div>
</div>
