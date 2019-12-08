<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\AboutUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(){
        $featured = Post::featured();    
        $pinned_posts = Post::PinnedPosts();
        $posts = Post::Posts();

        $archives = $this->getArchivedPost();
        $aboutUser = AboutUser::first(['about', 'git_url']);
        $categories = Category::all();
        
        return view('app', compact('posts', 'featured', 'categories', 'aboutUser', 'pinned_posts', 'archives'));
    }

    public function show(Post $post){
        return view('fe.posts.show', compact('post'));
    }

    public function getArchive($month, $year){
        $archive_posts = Post::whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->latest()
                        ->get();
        return view('fe.posts.archive', compact('archive_posts'));
    }


    // custon query
    public function getArchivedPost(){
        $archive_query = "select date_part('year', created_at) as year,
        date_part('month', created_at)as month, 
        count(*) published from posts 
        group by year, month order by min(created_at) desc";
        
        $archive_res = DB::select($archive_query);
        return json_decode(json_encode($archive_res), true);
    }
}
