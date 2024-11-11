<?php

use App\Models\Booking;

use function Livewire\Volt\{state, with};

//
state(['status' => ''])->url();

state(['statuses' => ['pending', 'confirmed', 'cancelled']]);

with(
    fn() => [
        'bookings' => Booking::where('customer_id', auth()->user()->id)
            ->where('status', 'like', '%' . $this->status . '%')
            ->latest()
            ->paginate(10),
    ],
);

?>

<div class="grid gap-8">
    <div class="flex justify-center">
        <div class="grid gap-1">
            <label hidden class="font-medium text-sm" for="status">Status</label>
            <select wire:model.live='status' class="rounded-md" name="status" id="status">
                <option value="">All Statuses</option>
                @forelse ($statuses as $status)
                    <option value={{ $status }}>{{ $status }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <div class="grid gap-4">
        {{ $bookings->links() }}
        <div class="grid sm:grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-8">
            @forelse ($bookings as $booking)
                <x-booking-card :booking="$booking"/>
            @empty
                No Bookings
            @endforelse
        </div>
        {{ $bookings->links() }}
    </div>

</div>
