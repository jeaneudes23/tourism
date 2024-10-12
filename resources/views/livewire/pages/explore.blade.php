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
    <div class="container py-16">
        <x-loader-fw />
        <div class="grid gap-4">
            <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse ($facilities as $facility)
                  <x-facility-card :facility="$facility"/>
                @empty
                    <p>No Facilities Found</p>
                @endforelse
            </div>
            {{ $facilities->links() }}
        </div>
    </div>
</div>
