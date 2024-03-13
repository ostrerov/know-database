<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostTags;
use Illuminate\Http\Request;
use Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:Администратор,Редактор');
    }

    public function index()
    {
        $postsList = Post::query()->paginate(20);
        $postsCount = Post::count();

        return view(
            'pages.dashboard.posts.index',
            compact(
                'postsList',
                'postsCount'
            )
        );
    }

    public function showPreview($id)
    {
        $post = Post::find($id);
        if ($post) {
            $tags = PostTags::query()->where(['post_id' => $id])->get('name');

            return view('pages.dashboard.posts.preview', compact(
                'post',
                'tags'
            ));
        }

        abort(404);
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        if ($post) {
            $tags = PostTags::query()->where(['post_id' => $id])->get('name');

            if ($post->id !== Auth::user()->id OR !Auth::user()->isAdmin()) {
                abort(403);
            }

            return view('pages.dashboard.posts.edit', compact('post', 'tags'));
        }

        abort(404);
    }

    public function createPost()
    {
        return view('pages.dashboard.posts.add');
    }

    public function uploadImageForm(Request $request)
    {
        $path = $request->file('file')->store(path: 'uploads/posts_images', options: 'public');
        return response()->json(['location' => "/storage/$path"]);
    }
}
