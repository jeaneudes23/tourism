<?php

namespace App\Notifications;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Facility;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingUpdate extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */


    private Booking $booking;
    private Customer $customer;
    private Service $service;
    private Facility $facility;

    public function __construct(Booking $booking)
    {
        //
        $this->booking = $booking;
        $this->customer = $booking->customer;
        $this->service = $booking->service;
        $this->facility = $booking->facility;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->greeting("Hello {$this->customer->name}")
        ->subject(env('APP_NAME')." {$this->facility->name} Booking Update")
        ->line("Service: {$this->service->name}")
        ->line("Your booking with {$this->facility->name} is {$this->booking->status}")
        ->line("Unit Price: {$this->service->unit_price} {$this->service->currency}, Quantity: {$this->booking->quantity} {$this->service->unit}(s), Total Price: {$this->booking->total_price} {$this->service->currency}")
        ->line($this->booking->manager_message)
        ->line('Thank you');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
