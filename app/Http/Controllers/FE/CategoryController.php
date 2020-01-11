<?php

namespace App\Http\Controllers\FE;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    // view all the post belonging to the category
    public function index(Category $category){
        $posts = $this->getCategoryPosts($category);
        // return $cat_posts;
        return view('fe.category.cat-list', compact('category', 'posts'));
    }

    protected function getCategoryPosts($category){
        $cat_query = "select p.id, p.post_title, left(p.post_body, 200) as post_body,
        p.created_at, concat(u.fname,' ', u.lname) as username
        from posts p inner join users u on p.user_id = u.id
        where category_id= :id order by p.created_at desc";

        $res = DB::select($cat_query, ['id'=>$category->id]);
        return json_decode(json_encode($res), true);
    }
}
