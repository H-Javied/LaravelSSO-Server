<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api', 'scope:view-user')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/logMeOut', function (Request $request) {
    $user = $request->user();
    $access_token = $user->token();
    DB::table("oauth_refresh_tokens")->where("access_token_id", $access_token->id)->delete();
    $access_token->delete();
    return response()->json([
        "message" => "Revoked"
    ]);
});
Route::middleware('auth:api')->get('/blog-Posts', function () {
    return view('blogPosts');
});
Route::middleware('auth:api')->get('/betaTesterPermission', function (Request $request) {
    $user = $request->user();
    User::where('email', $user["email"])->update(array(
        'permission' => 1,
    ));
    return response()->json([
        "message" => "GREEN"
    ]);
    // dd($user["email"]);
});
