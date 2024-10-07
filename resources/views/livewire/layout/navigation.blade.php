<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-background border-b border-gray-100  relative z-50">
    <!-- Primary Navigation Menu -->
    <div class="container flex h-16 items-center">
        <!-- Logo -->
        <div class="shrink-0 flex-grow flex items-center gap-6">
            <a href="{{ route('home') }}" wire:navigate>
                <livewire:application-logo />
            </a>

          
        </div>

        <div class="hidden lg:flex flex-grow justify-end gap-6">
            <!-- Search Bar -->
            <form method="get" action="explore" class="flex-grow max-w-64">
                <div class="flex-grow flex rounded-xl border bg-white focus-within:border-primary overflow-hidden items-center">
                    <span class="pl-2">
                        <x-heroicon-s-magnifying-glass class="size-6" />
                    </span>
                    <input type="search" name="q" id="" placeholder="Search"
                        class="w-full bg-transparent focus:ring-0 focus:border-current border-0">
                </div>
            </form>
            <x-nav-link :href="route('explore')" :active="request()->routeIs('explore')" wire:navigate>
              {{ __('Explore') }}
            </x-nav-link>
            @auth
                <div class="flex gap-4">
                    <x-nav-link :href="route('myspace.index')" :active="request()->routeIs('myspace.index')" wire:navigate>
                        {{ __('My Space') }}
                    </x-nav-link>
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name"></div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start">
                                    <x-dropdown-link>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            @endauth

            @if (!auth()->check())
                  <x-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>Login</x-nav-link>
                  <x-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>Register</x-nav-link>
            @endif

        </div>
        <!-- Hamburger -->
        <div class="flex items-center lg:hidden">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <x-heroicon-c-bars-3-bottom-right class="size-5"/>
            </button>
        </div>


    </div>

    <!-- Responsive Navigation Menu -->

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('explore')" :active="request()->routeIs('explore')" wire:navigate>
                {{ __('Explore') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('myspace.index')" :active="request()->routeIs('myspace.index')" wire:navigate>
                My Space
            </x-responsive-nav-link>
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                        x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @endauth
    </div>

</nav>
