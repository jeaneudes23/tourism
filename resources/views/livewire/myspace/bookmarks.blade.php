<?php

use App\Models\Category;
use App\Models\Location;

use function Livewire\Volt\{state, with, computed, usesPagination};

//
usesPagination();
state(['location'])->url();
state(['category'])->url();

$locations = computed(function () {
    return Location::get(['name']);
})->persist();

$categories = computed(function () {
    return Category::get(['slug', 'name']);
})->persist();

with(fn() => ['facilities' => auth()->user()->bookmarks()
->whereHas('categories', function($sub) {
  $sub->where('slug','like','%'. $this->category . '%');
})
->where('location', 'like', '%' . $this->location . '%')
->paginate(10),
]);

?>

<div class="grid gap-8">
    <div class="flex items-center justify-center gap-4">
        <div class="grid gap-1">
            <label hidden class="font-medium text-sm" for="category">Category</label>
            <select wire:model.live='category' class="rounded-md" name="category" id="category">
                <option value="">All Categories</option>
                @forelse ($this->categories as $category)
                    <option value={{ $category->slug }}>{{ $category->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="grid gap-1">
            <label hidden class="font-medium text-sm" for="location">Location</label>
            <select wire:model.live='location' class="rounded-md" name="location" id="loaction">
                <option value="">All Locations</option>
                @forelse ($this->locations as $location)
                    <option value={{ $location->name }}>{{ $location->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <div class="grid gap-4">
        <div class="grid gap-8 grid-cols-2">
            @forelse ($facilities as $facility)
              <x-facility-card :facility='$facility'/>
            @empty
                <p>No Facilities Found</p>
            @endforelse
        </div>
        {{ $facilities->links() }}
    </div>
</div>
