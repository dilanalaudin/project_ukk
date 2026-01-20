<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCounselingRequest extends Notification
{
    use Queueable;

    protected $studentName;
    protected $counselingDate;

    /**
     * Create a new notification instance.
     */
    public function __construct($studentName, $counselingDate)
    {
        $this->studentName = $studentName;
        $this->counselingDate = $counselingDate;
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
        return [
            'title' => 'Pengajuan Konseling Baru',
            'details' => "Siswa {$this->studentName} mengajukan konseling pada {$this->counselingDate}",
            'url' => route('admin.konseling.index'),
            'icon' => 'user-plus', // FontAwesome or similar icon name
        ];
    }
}
