<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('dashboard', compact([
            'posts'
        ]));
    }

    public function create()
    {
        return view('add-new-post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        Post::create($request->all());

        return redirect()->back()->with('status', 'Post added!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('edit-new-post', compact([
            'post'
        ]));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect()->back()->with('status', 'Post updated!');
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();

        return redirect()->route('dashboard')->with('status', 'Post deleted!');
    }
}
