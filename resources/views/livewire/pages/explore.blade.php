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
    return Category::get(['name','slug']);
})->persist();

$overlay = computed(function () {
  return 'storage/'.FrontPageContent::first()->overlay;
})->persist();

with(fn() => ['facilities' => Facility::search($this->category, $this->location, $this->q)]);

?>

<div>
    <div class="bg-gradient-to-tr from-primary from-20% to-80% via-green-600/60 bg-primary to-primary  grid">
        <div class="col-start-1 row-start-1">
          <img src={{asset($this->overlay)}} class="max-w-20 rotate-180">
        </div>
        <div class="col-start-1 row-start-1 self-end">
          <img src={{asset($this->overlay)}} class="max-w-32 float-end">
        </div>
        <div class="col-start-1 row-start-1 max-w-2xl px-4 mx-auto space-y-8 py-16 md:py-20 z-10">
          <h2 class="text-4xl font-bold capitalize text-center text-primary-foreground">Explore Places</h2>
          <div class="grid sm:grid-cols-3">
              <div class="grid gap-1">
                  <label hidden class="font-medium text-sm" for="category">Category</label>
                  <select wire:model.live='category' class="w-full rounded-l-md border-2 border-r-0" name="category" id="category">
                      <option value="">Select Category</option>
                      @forelse ($this->categories as $category)
                          <option value={{ $category->slug }}>{{ $category->name }}</option>
                      @empty
                      @endforelse
                  </select>
              </div>
              <div class="grid gap-1">
                  <label hidden class="font-medium text-sm" for="location">Location</label>
                  <select wire:model.live='location' class="w-full border-2" name="location" id="loaction">
                      <option value="">Select Location</option>
                      @forelse ($this->locations as $location)
                          <option value={{ $location->name }}>{{ $location->name }}</option>
                      @empty
                      @endforelse
                  </select>
              </div>
              <div class="grid gap-1">
                  <label hidden class="font-medium text-sm" for="category">Search</label>
                  <input placeholder="search" wire:model.live.debounce.300ms='q' type="search" class="w-full border-2 border-l-0 rounded-r-md">
              </div>
          </div>
      </div>
    </div>
    <div class="container py-16 max-w-7xl">
        <x-loader-fw />
        <div class="grid gap-4">
            <div class="grid gap-8">
                @forelse ($facilities as $facility)
                    <a href="{{ route('facilities.show', $facility->slug) }}" wire:navigate class="group block border rounded bg-white hover:bg-gray-100 transition-all p-2">
                       <div class="grid gap-4 md:grid-cols-[250px,1fr]">
                          <div>
                            <img class="h-auto w-full rounded" src="{{ asset('storage/' . $facility->image) }}" alt="">
                          </div>
                          <div class="grid gap-2 py-2">
                            <div class="inline-flex items-center">
                              <div class="divide-x font-medium text-sm text-primary">
                                @forelse ($facility->categories as $index => $category)
                                <span class={{$index === 0 ? 'pr-2' : 'px-2'}}>{{$category->name}}</span>
                                @empty
                                
                                @endforelse
                              </div>
                            </div>
                            <h3 class="text-2xl font-bold">{{$facility->name}}</h3>
                            <div class="line-clamp-2 max-w-xl">{{$facility->title}}</div>
                            <p><x-heroicon-o-map-pin class="size-5 inline"/><span class="font-medium">Location:</span> {{$facility->location}}</p>
                            <p><x-heroicon-o-home class="size-5 inline"/><span class="font-medium">Address:</span> {{$facility->address}}</p>
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



{{-- <div class="grid">
  <img class="col-start-1 row-start-1 w-full aspect-video object-cover rounded-xl shadow"
      src="{{ asset('storage/' . $facility->image) }}" alt="">
  <div class="col-start-1 row-start-1 rounded-xl">
      <div class="col-start-1 row-start-1 rounded-xl">
          <div class="bg-gradient-to-b from-black rounded-xl p-2">
              <span
                  class="py-1 px-2 text-sm font-bold rounded shadow bg-gray-100">{{ $facility->category->name }}</span>
          </div>
      </div>
  </div>
</div>
<div class="mt-2">
  <div class="inline-flex items-center text-sm font-medium gap-1">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
          <path stroke-linecap="round" stroke-linejoin="round"
              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
      </svg>
      {{ $facility->location }}
  </div>
  <h3 class="font-semibold">{{ $facility->name }} </h3>
</div> --}}
