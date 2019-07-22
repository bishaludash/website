<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;

class BlogController extends Controller
{
    public function index(){
        $featured_posts = Post::where('is_featured', 1)
                    ->where('archive',0)
                    ->latest()
                    ->limit(2)
                    ->get();

        $posts = Post::where('is_featured', 0)
        ->where('archive',0)
        ->get();

        $categories = Category::all();
        
        return view('app', compact('posts', 'featured_posts', 'categories'));
    }

    public function show(Post $post){
        return view('fe.posts.show', compact('post'));
    }
}
