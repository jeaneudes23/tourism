@props(['facility'])

<a href="{{ route('facilities.show', $facility->slug) }}" wire:navigate class="group block border rounded bg-white hover:bg-gray-100 transition-all p-2">
  <div class="grid gap-4 ">
      <div>
          <img class="h-52 object-cover w-full rounded" src="{{ asset('storage/' . $facility->image) }}" alt="">
      </div>
      <div class="grid gap-3">
          <div class="grid gap-1">
              <h3 class="text-2xl font-bold">{{ $facility->name }}</h3>
              <div class="divide-x font-medium text-sm ">
                  @forelse ($facility->categories as $index => $category)
                      <span
                          class={{ $index === 0 ? 'pr-2' : 'px-2' }}>{{ $category->name }}</span>
                  @empty
                  @endforelse
                  <span class="font-medium capitalize px-2 text-primary"><x-heroicon-o-map-pin
                          class="size-5 inline" /> {{ $facility->location }}</span>
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
          <p><x-heroicon-o-home class="size-5 inline" /><span class="font-medium">Address: </span>{{ $facility->address }}</p>
      </div>
  </div>
</a>