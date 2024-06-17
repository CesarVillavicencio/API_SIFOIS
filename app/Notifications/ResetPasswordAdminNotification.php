<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordAdminNotification extends Notification {
    use Queueable;

    public $url;

    public $from;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($url) {
        $this->url = $url;
        $this->from = [
            'email' => env('MAIL_FROM_ADDRESS', 'sys@komvac.com'),
            'name' => env('MAIL_FROM_NAME', 'Komvac'),
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        /*return (new MailMessage)
            ->from('sys@since.love', 'SinceLove Sys')
            ->subject(trans('passwords.reset_mail.subject'))
            ->greeting(trans('passwords.reset_mail.greetings'))
            ->line(trans('passwords.reset_mail.line1'))
            ->action(trans('passwords.reset_mail.action'), $this->url)
            ->line(trans('passwords.reset_mail.line2'))
            ->line(trans('passwords.reset_mail.line3'))
            ->line(trans('passwords.reset_mail.line4'));*/

        $url = $this->url;
        $from = $this->from;

        return (new MailMessage)
            ->from($this->from['email'], $this->from['name'])
            ->subject(trans('passwords.reset_mail.subject'))
            ->markdown('mails.adminuser_reset_password', compact('url', 'from'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}
