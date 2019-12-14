<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\AboutUser;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{   
    /* 
        FE blog home
    */
    public function index(){
        // Laravel queryscope
        $featured = Post::featured();    
        $pinned_posts = Post::PinnedPosts();
        
        // custom OOP
        $postRep = new Post();
        $posts = $postRep->getlatestPosts();

        $archives = $this->getArchivedPost();
        $aboutUser = AboutUser::first(['about', 'git_url']);
        $categories = Category::all();
        
        return view('app', compact('posts', 'featured', 'categories', 'aboutUser', 'pinned_posts', 'archives'));
    }

    /* 
        show individual post
    */
    public function show(Post $post){
        return view('fe.posts.show', compact('post'));
    }


    /* 
        get archived post according to month, year 
    */
    public function getArchive($month, $year){
        $archive_posts = Post::whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->latest()
                        ->get();
        return view('fe.posts.archive', compact('archive_posts'));
    }

    /* 
        search box logic
    */
    public function searchPost($keyword){
        $query = "select id, post_title, created_at, left(post_body, 200) as post_body
                from posts where lower(post_title) like lower(:search)";

        $query_res = DB::select($query, ["search"=>'%'.$keyword.'%']);
        return  json_decode(json_encode($query_res), true);
    }

    /* 
        FE search box view
    */
    public function searchPostView(Request $request){
        $input = $request['search_val'];
        $search_res = $this->searchPost($input);

        return view('fe.search.search', compact('search_res', 'input'));
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
