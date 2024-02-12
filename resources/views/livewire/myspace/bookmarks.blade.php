<?php

use App\Models\Category;
use App\Models\Location;

use function Livewire\Volt\{state, with, computed, usesPagination};

//
usesPagination();
state(['location'])->url();
state(['category'])->url();

$locations  = computed(function () {
    return Location::get(['name']);
})->persist();

$categories  = computed(function () {
    return Category::get(['id', 'name']);
})->persist();

with(fn () => ['facilities' => auth()->user()->bookmarks()->where('location', 'like', '%' . $this->location . '%')->where('category_id', 'like', '%' . $this->category . '%')->paginate(10)])

?>

<div class="flex gap-8">
    <div class="basis-1/5 items-start shrink-0">
        <div class="p-2 border rounded-md">
            <div class="px-2">
                <h3>Filters</h3>
            </div>
            <div class="px-2 grid py-4 gap-4">
                <div class="grid gap-1">
                    <label class="font-medium text-sm" for="category">Category</label>
                    <select wire:model.live='category' class="rounded-md" name="category" id="category">
                        <option value="">All</option>
                        @forelse ($this->categories as $category)
                        <option value={{$category->id}}>{{$category->name}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>
                <div class="grid gap-1">
                    <label class="font-medium text-sm" for="location">Location</label>
                    <select wire:model.live='location' class="rounded-md" name="location" id="loaction">
                        <option value="">All</option>
                        @forelse ($this->locations as $location)
                        <option value={{$location->name}}>{{$location->name}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>

            </div>
        </div>
    </div>
    <div class="grow">
        <x-loader-fw />
        <div class="grid gap-4">
            {{$facilities->links()}}
            <div class="grid gap-8 grid-cols-[repeat(auto-fill,minmax(250px,1fr))]">
                @forelse ($facilities as $facility)
                <a href="{{route('facilities.show', $facility->slug)}}" wire:navigate class="group block border rounded-xl hover:bg-gray-50 transition-all p-2">
                    <div class="grid">
                        <img class="col-start-1 row-start-1 w-full aspect-video object-cover rounded-xl shadow" src="{{asset('storage/'.$facility->image)}}" alt="">
                        <div class="col-start-1 row-start-1 rounded-xl">
                            <div class="bg-gradient-to-b from-black rounded-xl p-2">
                                <span class="py-1 px-2 text-sm font-bold rounded shadow bg-gray-100">{{$facility->category->name}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="inline-flex items-center text-sm font-medium gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            {{$facility->location}}
                        </div>
                        <h3 class="font-semibold">{{$facility->name}} </h3>
                    </div>

                </a>
                @empty
                No Bookmarks
                @endforelse
            </div>
            {{$facilities->links()}}

        </div>
    </div>

</div>