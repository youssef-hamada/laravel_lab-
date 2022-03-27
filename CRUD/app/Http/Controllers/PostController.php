<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use DB;


class PostController extends Controller
{
    
    public function index(){
        $posts = POST::paginate(2);
        // $posts = DB::select('select * from posts');

        // $name = $request->name;
        // dd($text);
        return view('/posts',['posts'=>$posts]);
        // dd($posts[0]->name);
        // foreach($posts as $post){
        //     dd($post);
        // }
    }


    public function show($post){
        $posts = POST::all();
        foreach($posts as $p){
            if($post == $p->user_id){

                return view('/view',['post'=>$p]);
            }
        }
    }

    public function edit($post){
        $posts = POST::all();
        foreach($posts as $p){
            if($post == $p->user_id){
                $user = DB::table('users')
                ->select('users.name')
                ->join('posts', 'posts.user_id', '=', 'users.id')
                ->where('posts.user_id', $p->user_id )
                ->get();
                // dd($user);
                return view('/edit',['post'=>$p,'user'=>$user]);
            }
        }
    }

    public function update(Request $request,$id){
        // $post = POST::find($id)->update([
        //     'desc' => $request->input('desc'),
        //     'name' => $request->input('name'),
        // ]);
        // $posts=[];
        
        // $post = POST::find($id);
        // $post->name = $request->input('name');
        // $post->desc = $request->input('desc');
        // $post->update();
        $post = DB::table('posts')
        ->where('user_id', $id)
        ->update([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            
        ]);
        return redirect( route('posts',$id));
        // return view('/posts');
        // dd($post);

    }

    public function insert(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
            'desc' => 'required|string|',
            // 'count' => new
        ]);

        //
            $prev =  DB::table('posts')->where('user_id', $request->input('user'))->count();
            if($prev < 3 ){

                // dd($prev);
                $post = new Post();
                $post->user_id = $request->input('user');
                $post->name = $request->input('name');
                $post->slug= SlugService::createSlug(Post::class,'slug',$request->input('name'));
            
                $post->desc = $request->input('desc');
                $post->save();
                $posts = POST::paginate(2);
                
                return to_route('posts');
            }else{
                echo "exceeded";
            }
        //

        

    }

    public function add(){
        $posts = POST::all();
        $users = DB::select('SELECT * FROM users');
        // dd($users);
        return view('/add',['users'=>$users,'posts'=>$posts]);
        // return redirect( route('add',$users,$posts));
    }

    public function del($id){
        DB::table('posts')->where('name', $id)->delete();
        $posts = POST::paginate(2);
        // return back();
        return view('/posts',['posts'=>$posts]);
        // return redirect( route('posts',$posts));

    }
}
