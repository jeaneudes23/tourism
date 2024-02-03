<x-app-layout>

        <section class="hero">
            <div class="grid">
                <div class="h-screen relative col-start-1 row-start-1 before:absolute before:inset-0 before:bg-black/25">
                    <img src="{{asset('storage/'.$frontPage->image)}}" class="h-full w-full object-cover" alt="">
                    
                </div>
                <div class="relative col-start-1 row-start-1 bg-gradient-to-r from-black/80">
                    <div class="max-w-7xl mx-auto px-4 h-screen grid content-center">
                        <div class="grid gap-4 mb-8">
                            <h1 class="text-4xl lg:text-6xl text-white font-bold tracking-wider">
                                {{$frontPage->title}}
                            </h1>
                            <p class="text-white max-w-screen-md font-medium tracking-wide md:text-lg">{{$frontPage->description}}</p>
                            <div class="flex text-sm gap-4 flex-wrap text-white">
                                @forelse ($locations as $location)
                                <a href="">
                                    <span class="inline-flex gap-1 font-medium capitalize px-3 py-1 items-center rounded-md  border-2 border-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                          </svg>
                                          {{$location->name}}
                                    </span>
                                </a>
                                @empty
                                    <p>No available Location</p>
                                @endforelse
                                
                            </div>
                        </div>
                        <a href="/search" class="h-10 md:h-12 px-8 md:px-12 gap-2 bg-green-600 inline-flex items-center rounded-full border-2 border-white tracking-wide font-medium text-white justify-self-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                              </svg>  
                            Explore
                        </a>
                        
                        
                    </div>
                </div>
                
            </div>
            
        </section>
        <section class="categories">
            <div class="max-w-7xl mx-auto px-4 py-16">
                <div class="inline-flex items-center mb-6  gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-component">
                        <path d="M5.5 8.5 9 12l-3.5 3.5L2 12l3.5-3.5Z"/>
                        <path d="m12 2 3.5 3.5L12 9 8.5 5.5 12 2Z"/>
                        <path d="M18.5 8.5 22 12l-3.5 3.5L15 12l3.5-3.5Z"/>
                        <path d="m12 15 3.5 3.5L12 22l-3.5-3.5L12 15Z"/>
                    </svg>
                    <h2 class="text-2xl font-semibold">Explore categories</h2>
                </div>
                <div class="grid gap-8 grid-cols-[repeat(auto-fit,minmax(250px,1fr))]">
                    @forelse ($categories as $category)
                    <a href="/search?category={{$category->name}}" class="group block border rounded-xl hover:bg-gray-50 transition-all p-2">
                        <div class="grid">
                            <img class="col-start-1 row-start-1 w-full aspect-video object-cover rounded-xl shadow" src="{{asset('storage/'.$category->image)}}" alt="">
                            <span class="col-start-1 -rotate-[14deg] group-hover:border-green-600 transition-all row-start-1 border-4 border-green-600 border-b-white border-l-white self-end bg-white w-16 -translate-x-1 grid place-content-center font-bold text-xl text-green-600 translate-y-4 aspect-square rounded-full"><span class="rotate-[14deg]">{{$category->facilities_count}}</span></span>
                        </div>
                        <div class="px-2">
                            <h3 class="font-semibold mb-1 mt-4">{{$category->name}} </h3>
                            <p>{{$category->description}}</p>
                        </div>
    
                    </a>
                    @empty
                        
                    @endforelse
                </div>
            </div>
            
        </section> 
    
</x-app-layout>