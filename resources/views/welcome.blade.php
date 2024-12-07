<x-app-layout>

    <section class="grid">
        <div class="container col-start-1 row-start-1 grid  place-content-center text-center py-16 lg:h-dvh z-10 bg-background lg:bg-transparent">
          <div class="grid gap-4 mb-8">
              <h1 class="text-4xl lg:text-6xl  font-bold tracking-wider">
                {{ $frontPage->title }}
              </h1>
              <p class="max-w-screen-md font-medium tracking-wide md:text-lg">{{ $frontPage->description }}</p>
              <div class="flex text-sm gap-4 flex-wrap justify-center">
                  @forelse ($locations as $location)
                      <a href="/explore?location={{ $location->name }}" wire:navigate>
                          <span
                              class="inline-flex gap-1 font-medium capitalize px-3 py-1 items-center rounded-full  border-2 ">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                  stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                              </svg>
                              {{ $location->name }}
                          </span>
                      </a>
                  @empty
                      <p>No available Location</p>
                  @endforelse

              </div>
          </div>
          <div class="flex justify-center">
              <a href="/explore" wire:navigate
                  class="h-10 md:h-12 px-8 md:px-12 gap-2 bg-primary inline-flex items-center rounded-full border-2 border-white tracking-wide font-medium text-white justify-self-start">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                  </svg>
                  Explore
              </a>
          </div>
      </div>
    </section>
    <section class="categories">
        <div class="container py-16 space-y-12">
            <h2 class="text-4xl font-bold text-center">Categories</h2>
            <div class="grid gap-8 grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(250px,1fr))]">
                @forelse ($categories as $category)
                    <a href="/explore?category={{ $category->slug }}" wire:navigate
                        class="grid border rounded hover:bg-gray-50 transition-all p-4 gap-4">
                        <img class="max-w-20 mx-auto" src="{{ asset('storage/' . $category->image) }}" alt="">
                        <h3 class="font-semibold text-2xl text-center">{{ $category->name }} </h3>
                    </a>
                @empty
                @endforelse
            </div>
        </div>

    </section>

</x-app-layout>
