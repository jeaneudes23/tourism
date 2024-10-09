<?php

use App\Models\Facility;
use App\Models\Category;
use App\Models\FrontPageContent;
use App\Models\Location;

use function Livewire\Volt\{state, layout, with, usesPagination, computed};

//
usesPagination();
layout('layouts.app');
state(['location'])->url();
state(['category'])->url();
state(['q'])->url();

$locations = computed(function () {
    return Location::get(['name']);
})->persist();

$categories = computed(function () {
    return Category::get(['name', 'slug']);
})->persist();

$overlay = computed(function () {
    return 'storage/' . FrontPageContent::first()->overlay;
})->persist();

with(fn() => ['facilities' => Facility::search($this->category, $this->location, $this->q)]);

?>

<div>
    <div class="bg-gradient-to-tr from-primary from-20% to-80% via-green-600/60 bg-primary to-primary  grid">
        <div class="col-start-1 row-start-1">
            <img src={{ asset($this->overlay) }} class="max-w-20 rotate-180">
        </div>
        <div class="col-start-1 row-start-1 self-end">
            <img src={{ asset($this->overlay) }} class="max-w-32 float-end">
        </div>
        <div class="col-start-1 row-start-1 max-w-2xl px-4 mx-auto space-y-8 py-16 md:py-20 z-10">
            <h2 class="text-4xl font-bold capitalize text-center text-primary-foreground">Explore Places</h2>
            <div class="grid sm:grid-cols-3">
                <div class="grid gap-1">
                    <label hidden class="font-medium text-sm" for="category">Category</label>
                    <select wire:model.live='category' class="w-full rounded-l-md border-2 border-r-0 outline-none" name="category"
                        id="category">
                        <option value="">All Categories</option>
                        @forelse ($this->categories as $category)
                            <option value={{ $category->slug }}>{{ $category->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="grid gap-1">
                    <label hidden class="font-medium text-sm" for="location">Location</label>
                    <select wire:model.live='location' class="w-full border-2 outline-none" name="location" id="loaction">
                        <option value="">All locations</option>
                        @forelse ($this->locations as $location)
                            <option value={{ $location->name }}>{{ $location->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="grid gap-1">
                    <label hidden class="font-medium text-sm" for="category">Search</label>
                    <input placeholder="search" wire:model.live.debounce.300ms='q' type="search" class="w-full border-2 border-l-0 rounded-r-md outline-none">
                </div>
            </div>
        </div>
    </div>
    <div class="container py-16 max-w-7xl">
        <x-loader-fw />
        <div class="grid gap-4">
            <div class="grid gap-8">
                @forelse ($facilities as $facility)
                    <a href="{{ route('facilities.show', $facility->slug) }}" wire:navigate
                        class="group block border rounded bg-white hover:bg-gray-100 transition-all p-2">
                        <div class="grid gap-4 md:grid-cols-[250px,1fr]">
                            <div>
                                <img class="h-auto w-full rounded" src="{{ asset('storage/' . $facility->image) }}"
                                    alt="">
                            </div>
                            <div class="grid gap-3">
                                <div class="grid gap-1">
                                    <h3 class="text-2xl font-bold">{{ $facility->name }}</h3>
                                    <div class="divide-x font-medium text-sm ">
                                        @forelse ($facility->categories as $index => $category)
                                            <span class={{ $index === 0 ? 'pr-2' : 'px-2' }}>{{ $category->name }}</span>
                                        @empty
                                        @endforelse
                                        <span class="font-medium capitalize px-2 text-primary"><x-heroicon-o-map-pin class="size-5 inline" /> {{ $facility->location }}</span>
                                    </div>
                                </div>
                                <p class="line-clamp-2 max-w-xl">{{ $facility->title }}</p>
                                <div class="inline-flex items-center gap-x-6 gap-y-2 flex-wrap">
                                    @forelse ($facility->services as $key => $service)
                                        <div class="inline-flex items-center gap-1">
                                            <x-heroicon-m-check class="size-5 text-green-600" />
                                            <span class="text-sm font-bold capitalize">{{ $service->name }}</span>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                                <p><x-heroicon-o-map-pin class="size-5 inline" /><span
                                        class="font-medium">Location:</span> {{ $facility->location }}</p>
                                <p><x-heroicon-o-home class="size-5 inline" /><span class="font-medium">Address:</span>
                                    {{ $facility->address }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p>No Facilities Found</p>
                @endforelse
            </div>
            {{ $facilities->links() }}
        </div>
    </div>
</div>
