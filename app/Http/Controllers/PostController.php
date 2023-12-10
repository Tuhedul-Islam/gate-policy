<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit($id){
        $post = Post::find($id);

        // authorize the user's action from Gate
        if (Gate::allows('isAdmin')) {
            print('Admin allowed');
        }
        elseif(Gate::allows('isManager')) {
            print('Manager allowed');
        }
        elseif(Gate::allows('isUser')) {
            print('User allowed');
        }
        else{
            print('You are not Nothing');
        }

        // authorize the user's action from policy
        $this->authorize('update', [$post, $id]);
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function update(Request $request, Post $post)
    {
        // authorize the user's action
        $this->authorize('update', $post);

        // update the post
        $post->update($request->all());

        return redirect()->route('posts.home', $post);
    }*/
}
