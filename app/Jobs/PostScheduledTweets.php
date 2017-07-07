<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use App\Tweet;
use App\User;
use App\Profile;
use Twitter;
use Session;

class PostScheduledTweets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $text;
    public $tweet_id;
    public $user;
    public $request_token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Tweet $tweet)
    {
        $this->text = $tweet->text;
        $this->tweet_id = $tweet->id;
        $this->user = User::find($tweet->user_id);
        
        $this->request_token = [
            'token'  => $this->user->oauth_token,
            'secret' => $this->user->oauth_token_secret,
        ];
        
        Session::put('access_token', $this->request_token);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Twitter::reconfig($this->request_token);
        $posted = Twitter::postTweet(['status' => $this->text]);
     
        if($posted)
        {
            Tweet::where('id', $this->tweet_id)->update(['posted' => true]);
        }
    }
}
