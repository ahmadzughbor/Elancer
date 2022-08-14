<?php

namespace App\Notifications;

use App\channels\log;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class NewProposalNotification extends Notification
{
    use Queueable;
    protected $proposal;
    protected $freelancer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal, User $freelancer)
    {
        $this->proposal = $proposal;
        $this->freelancer = $freelancer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // $via =['database','mail','broadcast','nexmo'];
        $via = [log::class];
        if ($notifiable->notify_mail) {
            $via[] = 'mail';
        }
        if ($notifiable->notify_sms) {
            $via[] = 'nexmo';
        }
        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );
        $message = new MailMessage;
        $message->subject('new proposal')
            ->greeting('hello' . $notifiable->name)
            ->line($body)
            ->action('view to proposal', route('projects.show', $this->proposal->project_id))
            ->line('Thank you for using our application!');
        return $message;
    }

    public function toDatabase($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );
        return [
            'title' => 'new Proposal',
            'body' => $body,
            'icon' => '',
            'url' => route('projects.show', $this->proposal->project_id),
        ];
    }
    public function toBroadcast($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );
        return new BroadcastMessage([
            'title' => 'new Proposal',
            'body' => $body,
            'icon' => '',
            'url' => route('projects.show', $this->proposal->project_id),
        ]);
    }
    public function toNexmo($notifiable)
    {

        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title
        );
        $message = new NexmoMessage();
        $message->content($body);
    }
    public function toLog($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );
        return $body;
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
