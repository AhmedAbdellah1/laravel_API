<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Resources\PosResources;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponseTrait;

    // write a function to get all posts
    public function index()
    {
        // $posts = PosResources::collection(Post::all());
        return $this->successResponseWithData(PosResources::collection(Post::all()), 'Posts fetched successfully', 200);
    }

    // write a function to get a single post
    public function show(Post $post)
    {
        // $post = new PosResources($post);
        return $this->successResponseWithData(new PosResources($post), 'Post fetched successfully', 200);
    }
    // write a function to create a post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(null, $validator->errors(), 400);
        }
        $post = Post::create($request->all());
        return $this->successResponseWithData(new PosResources($post), 'Post created successfully', 2001);
    }
    // write a function to update a post
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(null, $validator->errors(), 400);
        }

        $post = Post::find($id);
        $post->update($request->all());

        if (!$post) {
            return $this->errorResponse(null, 'you have no access to this post', 401);
        }

        return $this->successResponseWithData(new PosResources($post), 'Post updated successfully', 2002);
    }

    // write a function to delete a post
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->errorResponseForDelete("you have no access to this post with id = $id ", 401);
        }
        $post->delete();
        return $this->successResponseWithData(null, 'Post deleted successfully', 2003);
    }
}
