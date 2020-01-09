<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\AboutUser;
use App\Logic\FE\BlogFeLogic;
use App\Traits\DBUtils;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{   
    use DBUtils;
    /* 
        FE blog home
    */
    public function index(){
        $blog = new BlogFeLogic();
        $featured = $blog->getFeaturedPost();
        $pinned_posts = $blog->getPinnedPost();
        $posts = $blog->getLatestPost();

        $archives = $blog->getArchivedPost();
        $aboutUser = AboutUser::first(['about', 'git_url']);
        $categories = Category::all();
        
        return view('app', compact('posts', 'featured', 'categories', 'aboutUser', 'pinned_posts', 'archives'));
    }

    /* 
        show individual post
    */
    public function show($post){
            $post_query = "select p.id, p.post_title, p.post_body, p.created_at,
                       iu.image_path, c.cat_name from posts p 
                       left join image_managers iu on p.id=iu.foreign_id
                       inner join categories c on p.category_id = c.id
                       where p.id = :id order by iu.created_at desc";
        
        $post = $this->selectFirstQuery($post_query, ['id'=>$post]);

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

}
