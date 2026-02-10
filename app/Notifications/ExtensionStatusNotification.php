<?php

namespace App\Notifications;

use App\Models\BookingExtension;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExtensionStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private BookingExtension $extension;
    private string $action; // 'approved' or 'rejected'

    /**
     * Create a new notification instance.
     */
    public function __construct(BookingExtension $extension, string $action)
    {
        $this->extension = $extension;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $booking = $this->extension->booking;
        $car = $booking->car;

        if ($this->action === 'approved') {
            return (new MailMessage)
                ->greeting("Hai {$notifiable->name},")
                ->line("Permintaan perpanjangan sewa Anda untuk " . $car->name . " telah **disetujui**!")
                ->line("Waktu sewa yang baru:")
                ->line("📅 Awal Sewa: " . $booking->start_datetime->format('d M Y H:i'))
                ->line("📅 Akhir Sewa (Baru): " . $this->extension->new_end_datetime->format('d M Y H:i'))
                ->line("")
                ->line("💰 Biaya Tambahan: IDR " . number_format($this->extension->extra_price, 0, ',', '.'))
                ->action('Lihat Detail Booking', route('bookings.show', $booking->id))
                ->line("Terima kasih telah mempercayai Squad Trans!")
                ->line("Silakan lanjutkan perjalanan Anda dengan aman dan nyaman.");
        }

        return (new MailMessage)
            ->greeting("Hai {$notifiable->name},")
            ->line("Permintaan perpanjangan sewa Anda untuk " . $car->name . " telah **ditolak**.")
            ->line("Waktu sewa yang diminta:")
            ->line("📅 Awal Sewa: " . $booking->start_datetime->format('d M Y H:i'))
            ->line("📅 Akhir Sewa (Diminta): " . $this->extension->new_end_datetime->format('d M Y H:i'))
            ->line("")
            ->line("Mohon kembalikan mobil sesuai jadwal awal sewa:")
            ->line("📅 **Akhir Sewa: " . $this->extension->old_end_datetime->format('d M Y H:i') . "**")
            ->action('Lihat Detail Booking', route('bookings.show', $booking->id))
            ->line("Jika ada pertanyaan, silakan hubungi kami.")
            ->line("Terima kasih telah menggunakan Squad Trans!");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'extension_id' => $this->extension->id,
            'booking_id' => $this->extension->booking_id,
            'action' => $this->action,
            'status' => $this->action === 'approved' ? 'Perpanjangan Disetujui' : 'Perpanjangan Ditolak',
            'message' => $this->action === 'approved'
                ? 'Permintaan perpanjangan sewa Anda telah disetujui'
                : 'Permintaan perpanjangan sewa Anda telah ditolak',
        ];
    }
}
