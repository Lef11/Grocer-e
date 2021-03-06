<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //


    protected function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('images/' . $value);
    }

    public function index(){

        $posts = auth()->user()->posts()->paginate(5); //Εμφανίζει μονο τα post τα οποια εχεις κανει εσυ!


        //$posts = Post::all();


        foreach($posts as $post){
            $post->post_image = $this->getPostImageAttribute($post->post_image);
        }

        return view('admin.posts.index', ['posts' => $posts]);
    }


    public function show(Post $post){



        return view('blog-post', ['post'=> $post]);

    }

    public function create(User $user){

        return view('admin.posts.create');
    }

//     public function store(){

//         $inputs = request()->validate([
//             'title'=>'required|min:8|max:255',
//             'post_image'=>'file',
//             'body'=>'required'

//          ]);
//     if(request('post_image')){
//         $inputs['post_image'] = request('post_image')->store('images');
//     }
//     //dd($request->post_image);
//     auth()->user()->posts()->create($inputs);
//     return back();

//     }
public function store(){
    $this->authorize('create', Post::class);

    $input = request()->validate([
      'title' => 'required|min:8|max:255',
       'post_image'=>'file',
        'body' => 'required'
   ]);

  if($file = request('post_image')){

       $name = $file->getClientOriginalName();
       $file->move('images', $name);
        $input['post_image'] = $name;
    }
    auth()->user()->posts()->create($input); //Dinei Id sto post analoga me otn user
    session()->flash('post-created-message', 'Post was Created');
    return redirect()->route('post.index');
}

public function edit(Post $post){

    $this->authorize('view', $post); // Δεν εχουμε εγκριση να ανοίξουμε τα ξένα ποστσ
    //if(auth()->user()->can('view', $post)){...}
    return view('admin.posts.edit', ['post'=>$post]);

}


public function destroy(Post $post){
    $this->authorize('delete', $post);
    $post->delete();
    Session::flash('message', 'Post was deleted');
    return back();
}

public function update(Post $post){
    $input = request()->validate([
        'title' => 'required|min:8|max:255',
         'post_image'=>'file',
          'body' => 'required'
     ]);

     //$post = new Post();
     //$post->title = request('title');

    if($file = request('post_image')){
        $this->authorize('update', $post);

         $name = $file->getClientOriginalName();
          $file->move('images', $name);
          $input['post_image'] = $name;
          $post->post_image = $input['post_image'];
      }
      $post->title = $input['title'];
      $post->body = $input['body'];


      $post->update();
      session()->flash('post-updated-message', 'Post Updated ' . $input['title']);
      return redirect()->route('post.index');

      //dd($input);
}


}


