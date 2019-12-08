<?php

namespace App\Http\Controllers\FE;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    // view all the post belonging to the category
    public function index(Category $category){
        $cat_posts = $this->getCategoryPosts($category);
        // return $cat_posts;
        return view('fe.category.cat-list', compact('category', 'cat_posts'));
    }

    protected function getCategoryPosts($category){
        $cat_query = "select p.id, p.post_title, p.post_body, p.updated_at::timestamp,
        concat(u.fname,' ', u.lname) as user
        from posts p inner join users u on p.user_id = u.id
        where category_id= :id";

        $res = DB::select($cat_query, ['id'=>$category->id]);
        return json_decode(json_encode($res), true);
    }
}
