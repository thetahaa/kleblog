<?php

namespace App\Jobs;

use App\Mail\NewCommentNotification;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentNotificationToAdmin implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

protected $comment;
    public function __construct( Comment $comment)
    {
        $this->comment = $comment;
    }

    public function handle()
    {
        $admins = User::role('super_admin')->get();
        
        foreach ($admins as $admin) {
            Mail::to($admin->email)->queue(new NewCommentNotification($this->comment));
        }
    }
}