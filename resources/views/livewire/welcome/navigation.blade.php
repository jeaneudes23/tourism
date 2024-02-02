<div class="fixed top-0 w-full z-10 bg-white border-b text-gray-800 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center gap-8 grow">
                <a href="/" class="text-xl font-bold capitalize">
                    <span class="inline-flex gap-1 items-center">
                        <x-application-logo />
                        <span class="hidden sm:block">
                            {{ config('app.name') }}
                        </span>                      
                    </span>
                </a>
                <form method="get" action="search" class="flex  basis-96">
                    <span class="shrink-0 border border-current pl-2 rounded-l-full border-r-0 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                          </svg>                      
                    </span>
                    <input type="text" name="q" id="" placeholder="Search" class="w-full bg-transparent border border-l-0 border-current pr-2 rounded-r-full focus:ring-0 focus:border-current">
                </form>
            </div>
            
            <div class="gap-4 hidden md:flex">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 border-2 rounded-full" wire:navigate>Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 border-2 rounded-full border-current" wire:navigate>Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 border-2 rounded-full text-white border-green-600 bg-green-600 " wire:navigate>Register</a>
                    @endif
                @endauth
            </div>

        </div>
    </div>
    
</div>
