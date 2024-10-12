@props(['booking'])

<div class="grid gap-4 rounded-lg shadow p-3">
    @if ($booking->service->image)
        <div><img class="w-full aspect-video rounded-l-md object-cover" src="{{ '/storage/' . $booking->service->image }}"alt=""></div>
    @endif
    <div class=" grid gap-2">
        <div class="space-y-2">
            <div>
                <a class="hover:text-primary transition-all"
                    href="{{ route('facilities.show', $booking->facility->slug) }}">
                    <span class="font-medium">Facility: </span>{{ $booking->facility->name }}
                </a>
            </div>
            <div><span class="font-medium">Service: </span> {{ $booking->service->name }}
                (x{{ $booking->quantity }}
                {{ \Illuminate\Support\Str::plural($booking->service->unit) }}) on
                {{ $booking->booking_date }}
            </div>
            <div><span class="font-medium">Total: </span><span>{{ $booking->total_price }}</span><span> {{$booking->service->currency}}</span></div>
            <div><span class="font-medium">Date Booked: </span><span>{{ $booking->booking_date }}</span></div>
            <div class="flex items-center gap-4">
                <span
                    class="px-2 capitalize py-1 rounded-full text-sm font-medium {{ $booking->status === 'confirmed' ? 'bg-green-600 text-gray-50' : ($booking->status === 'pending' ? 'bg-yellow-600 text-gray-50' : 'bg-red-600 text-gray-50') }}">{{ $booking->status }}</span>
                @if ($booking->status)
                    <p class="font-medium">{{ $booking->confirm_date }}</p>
                @endif
            </div>

            @if ($booking->manager_message)
                <div class="space-y-3">
                    <p class="font-medium text-lg underline">Manager Message</p>
                    <p class="">{{ $booking->manager_message }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
