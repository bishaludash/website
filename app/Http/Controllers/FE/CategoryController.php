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
        // return $post = DB::select($this->get_category_posts,[$category->id]);
        $post = DB::select('select post_title,substr(post_body, 1, 200) as post_body, created_at, image_path,id from posts where category_id = :id',['id'=>$category->id]);
        
        $category['posts'] = $post;
        foreach($category['posts'] as $cp){
            echo $cp->post_title;
        }
        
        // return view('fe.category.index');
    }
}
