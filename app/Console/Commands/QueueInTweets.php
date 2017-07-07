<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\PostScheduledTweets;
use App\Tweet;

class QueueInTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:tweets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push tweets to queue.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = time();
        $tweets = Tweet::where('time', '<=', $now)->where('posted', false)->get();
        foreach($tweets as $tweet)
        {
            dispatch((new PostScheduledTweets($tweet)));
        }

        echo count($tweets)." tweets queued.";
    }
}
