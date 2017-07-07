<?php

namespace App\Http\Controllers;

use App\Tweet;
use Twitter;
use Session;
use Redirect;
use Auth;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TweetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $time = strtotime($request->tweet_time.':00') - $user->profile->utc_offset;
        $now = time();

        if($time < $now)
        {
            if(Twitter::postTweet(['status' => $request->tweet_text]))
            {
                return back()->with('success', 'Your tweet was posted successfully.');
            }
            else
            {
                return back()->with('error', 'Your tweet could not be posted.');
            }
        }
        else
        {
            $tweet = new Tweet;
            $tweet->text = $request->tweet_text;
            $tweet->user_id = Auth::user()->id;
            $tweet->time = $time;
            $tweet->posted = false;
            $tweet->save();

            return back()->with('success' , 'Scheduled successfully.');
        }
    }

    public function edit($id)
    {
        $data['tweet'] = Tweet::find($id);
        $data['user'] = User::find(Auth::user()->id);
        $data['profile'] = $data['user']->profile;
        $data['scheduledTweets'] = Tweet::where('posted', false)->get();

        return view('tweets.edit', $data);
    }

    public function update($id, Request $request)
    {
        $user = User::find(Auth::user()->id);
        $time = strtotime($request->tweet_time.':00') - $user->profile->utc_offset;
        $now = time();

        if($time < $now)
        {
            if(Twitter::postTweet(['status' => $request->tweet_text]))
            {
                return back()->with('success', 'Your tweet was posted successfully.');
            }
            else
            {
                return back()->with('error', 'Your tweet could not be posted.');
            }
        }
        else
        {
            $tweet = Tweet::find($id);
            $tweet->text = $request->tweet_text;
            $tweet->user_id = Auth::user()->id;
            $tweet->time = $time;
            $tweet->posted = false;
            $tweet->save();

            return back()->with('success' , 'Re-scheduled successfully.');
        }

    }

    public function delete($id)
    {
        Tweet::destroy($id);
        return back()->with('success' , 'Tweet removed from queue.');
    }
}
