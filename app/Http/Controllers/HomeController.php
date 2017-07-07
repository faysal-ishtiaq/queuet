<?php

namespace App\Http\Controllers;

use Twitter;
use Session;
use Redirect;
use Auth;
use App\User;
use App\Tweet;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function landingpage()
    {
        return view('landingpage');
    }

    public function home()
    {
        if (Session::has('oauth_request_token'))
        {
            $data['user'] = User::find(Auth::user()->id);
            $data['profile'] = $data['user']->profile;
            $data['scheduledTweets'] = Tweet::where('posted', false)->get();

            $request_token = [
                'token'  => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            $user = User::where('oauth_token', $request_token['token'])->where('oauth_token_secret', $request_token['secret'])->first();

            if($user)
            {
                Auth::loginUsingId($user->id);
            }

            return view('home', $data);
        }
        else
        {
            return redirect(route('twitter.login'));
        }
    }
}
