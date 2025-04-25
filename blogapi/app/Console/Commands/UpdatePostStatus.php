<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class UpdatePostStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $signature = 'posts:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    public $description = 'posts:update-status';

     /**
     * Execute the console command.
     */
    public function handle() {
        Post::where(function($query) {
            $query->where('publish_at', '<=', now())
                  ->orWhereNull('publish_at');
        })->where('status', false)
          ->update(['status' => true]);
    
        Post::where('expire_at', '<=', now())
            ->where('status', true)
            ->update(['status' => false]);
    }
    
}
  