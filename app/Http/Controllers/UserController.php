<?php

namespace App\Http\Controllers;

use Twitter;
use Session;
use Redirect;
use Auth;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function login()
    {
        // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = false;

        // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.callback'));
        
        if (isset($token['oauth_token_secret']))
        {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);
            
            return Redirect::to($url);
        }

        return Redirect::route('twitter.error');
    }

    public function callback()
    {
        // You should set this route on your Twitter Application settings as the callback
        // https://apps.twitter.com/app/YOUR-APP-ID/settings
        if (Session::has('oauth_request_token'))
        {
            $request_token = [
                'token'  => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            Twitter::reconfig($request_token);

            $oauth_verifier = false;

            if (Input::has('oauth_verifier'))
            {
                $oauth_verifier = Input::get('oauth_verifier');
                // getAccessToken() will reset the token for you
                $token = Twitter::getAccessToken($oauth_verifier);
            }

            if (!isset($token['oauth_token_secret']))
            {
                return Redirect::route('twitter.error')->with('flash_error', 'We could not log you in on Twitter.');
            }

            $credentials = Twitter::getCredentials(['include_email' => 'true']);

            if (is_object($credentials) && !isset($credentials->error))
            {
                // dd($credentials);
                
                $user = User::where('id_str', $credentials->id_str)->first();

                if($user)
                {
                    $user->oauth_token = $token['oauth_token'];
                    $user->oauth_token_secret = $token['oauth_token_secret'];
                    Auth::loginUsingId($user->id);
                }
                else
                {
                    $user = new User;
                    $user->name = $credentials->name;
                    $user->id_str = $credentials->id_str;
                    $user->oauth_token = $token['oauth_token'];
                    $user->oauth_token_secret = $token['oauth_token_secret'];
                    if(isset($credentials->email)) $user->email = $credentials->email;
                    $user->save();
                }

                $profile_exists = Profile::where('user_id', $user->id)->first();

                if(!$profile_exists)
                {
                    $profile = new Profile;
                    $profile->user_id = $user->id;
                    $profile->screen_name = $credentials->screen_name;
                    $profile->location = $credentials->location;
                    $profile->description = $credentials->description;
                    $profile->url = $credentials->url;
                    $profile->followers = $credentials->followers_count;
                    $profile->following = $credentials->friends_count;
                    $profile->utc_offset = $credentials->utc_offset;
                    $profile->time_zone = $credentials->time_zone;
                    $profile->image_url = $credentials->profile_image_url;
                    $profile->banner_url = $credentials->profile_banner_url;
                    $profile->save();

                    Auth::loginUsingId($user->id);
                }
                else
                {
                    $profile = $profile_exists;
                }
                
                Session::put('access_token', $token);

                return Redirect::to('/home')->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
            }

            return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
        }
    }

    public function logout()
    {
        Session::forget('access_token');
        Auth::logout();
        return Redirect::to('/')->with('flash_notice', 'You\'ve successfully logged out!');
    }
}
