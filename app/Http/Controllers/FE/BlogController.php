<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\AboutUser;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(){
        $featured = Post::featured();    
        $pinned_posts = Post::PinnedPosts();
        $posts = Post::Posts();

        // view composer
        $archives = Post::Archive();
        $aboutUser = AboutUser::first(['about', 'git_url']);

        $categories = Category::all();
        
        return view('app', compact('posts', 'featured', 'categories', 'aboutUser', 'pinned_posts', 'archives'));
    }

    public function show(Post $post){
        return view('fe.posts.show', compact('post'));
    }

    public function getArchive($month, $year){
        $month = Carbon::parse($month)->month;
        $archive_posts = Post::whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->latest()
                        ->get();
        return view('fe.posts.archive', compact('archive_posts'));
    }
}
