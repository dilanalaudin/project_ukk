<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CounselingStatusUpdated extends Notification
{
    use Queueable;

    protected $status;
    protected $feedback;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $feedback = null)
    {
        $this->status = $status;
        $this->feedback = $feedback;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $message = "Status pengajuan konseling Anda telah diperbarui menjadi: " . ucfirst($this->status);
        if ($this->feedback) {
            $message .= ". Catatan: " . $this->feedback;
        }

        return [
            'title' => 'Update Status Konseling',
            'details' => $message,
            'url' => route('siswa.konseling.index'),
            'icon' => 'info-circle',
        ];
    }
}
