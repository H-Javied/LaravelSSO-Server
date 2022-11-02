<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function getDifferentAccount(Request $request)
    {
        //Log out current user
        Auth::logout();
        // set the intended url to the authorize url
        Session::put("url.intended", $request->current_url);
        //redirect to login
        return redirect("login");
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPermission(Request $request)
    {
        $user = $request->user();
        //$access_token = $user->token();
        //DB::table("oauth_refresh_tokens")->where("access_token_id", $access_token->id);
        return response()->json([$user], 200);
    }

    public function blogPosts()
    {
        return view('blogPosts');
    }
}
