<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiPostController;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
// use DB;

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

Route::middleware('auth:api')->get('/posts', function (Request $request) {
    return $request->user();
});


//show



Route::get('/test-api',function () {
    $posts = Post::all();
    return $posts;
})->middleware('auth:sanctum');


//update

Route::put('/test-api/{id}/{name}/{desc}', function ($id,$name,$desc) {
    $post = DB::table('posts')
        ->where('user_id', $id)
        ->update([
            'name' => $name,
            'desc' => $desc,
            
        ]);
        $posts = Post::all();
        return $posts;
})->middleware('auth:sanctum');


Route::post('/test-api/{id}/{name}/{desc}', function ($id,$name,$desc) {
    // $request->validate([
    //     'name' => 'required|string|max:50',
    //     'desc' => 'required|string|',
    // ]);

    //
        $prev =  DB::table('posts')->where('user_id', $id)->count();
        if($prev < 3 ){

            // dd($prev);
            $post = new Post();
            $post->user_id = $id;
            $post->name = $name;
            $post->slug= SlugService::createSlug(Post::class,'slug',$name);
        
            $post->desc = $desc;
            $post->save();
            $posts = Post::all();
            return $posts;
            // $posts = POST::paginate(2);
            
            // return to_route('posts');
        }else{
            echo "exceeded";
        }
})->middleware('auth:sanctum');

    
    
Route::delete('/test-api/{name}', function ($name) {
// $posts = Post::Find($name);
DB::table('posts')->where('name', $name)->delete();
$posts = Post::all();
return $posts;

// Route::get('/test-api', 'ApiPostController@index');
});


// check for tokens
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken($request->device_name)->plainTextToken;
});