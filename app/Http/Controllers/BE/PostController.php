<?php

namespace App\Http\Controllers\BE;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\ImageManager;
use phpDocumentor\Reflection\Types\Null_;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('cat_name', 'id');
        return view('backend.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_title' => 'required',
            'category_id' => 'required',
            'post_body' => 'required',
            'is_featured' => 'required',
        ]);

        // handle image
        $format = ['jpg', 'jpeg', 'png'];
        if ($file = $request->file('post_image')) {
            $ext = $file->getClientOriginalExtension();

            // validate extension
            if (!in_array(strtolower($ext), $format)) {
                session()->flash('message_danger', 'Please upload a valid image.');
                return back();
            }
            $file_name = str_random(10) . '-' . time() . '-' . $file->getClientOriginalName();
        }
        $input =  $request->all();
        $input['image_path'] = $request->file('post_image')->storeAs('posts', $file_name, 'uploads');

        // Upload to image manager
        ImageManager::create([
            'image_path' => $input['image_path']
        ]);
        
        $post = Post::create([
            'post_title' => $input['post_title'],
            'category_id' => $input['category_id'],
            'image_path' => $input['image_path'] ?? Null,
            'post_body' => $input['post_body'],
            'user_id' => auth()->id(),
            'is_featured' => $input['is_featured'],
            'archive' => $input['archive'] ?? '0',
        ]);

        if (!$post) {
            session()->flash('message_danger', 'Post could not be inserted.');
            return back();
        }
        session()->flash('message_success', 'Post created successfully.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return "delete";
    }
}
