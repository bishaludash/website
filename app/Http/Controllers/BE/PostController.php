<?php

namespace App\Http\Controllers\BE;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\ImageManager;
use App\Logic\Utils\FileHandler;
use App\Traits\DBUtils;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    use DBUtils;
    public $image_bucket = 'posts';
    public $disk = 'uploads';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get(['id', 'post_title','is_featured','archive','is_pinned',
                                    'created_at']);
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
            'is_pinned' => 'required',
        ]);
        $input =  $request->all();
        // validate bulk image, if error flash message.
        if ($request->hasFile('post_image')){
            $image_handler = new FileHandler();
            $errors=$image_handler->validateImage([$input['post_image']]);

            if (!empty($errors) || !is_null($errors)) {
                session()->flash('message_danger', 
                'Please upload a valid image (jpg, jpeg, png, gif). <br>Invalid file : <b>'.$errors.'<b>');
                return back()->withInput();
            }
        }
                
        $post = Post::create([
            'post_title' => $input['post_title'],
            'category_id' => $input['category_id'],
            'post_body' => $input['post_body'],
            'user_id' => auth()->id(),
            'is_featured' => $input['is_featured'],
            'is_pinned' => $input['is_pinned'],
        ]);

        
        // upload image
        if ($request->hasFile('post_image')) {
            $image_handler->uploadFile([$input['post_image']], $post->id, $this->image_bucket);
        }

        if (!$post) {
            session()->flash('message_danger', 'Post could not be inserted.');
            return back();
        }
        session()->flash('message_success', 'Post created successfully.');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('cat_name', 'id');
        $image_query = "select iu.image_path from image_managers iu
                       inner join  posts p  on p.id=iu.foreign_id
                       where p.id = :id order by iu.created_at desc limit 1";
        
        $image = $this->selectFirstQuery($image_query, ['id'=>$post->id]);
        return view('backend.posts.edit', compact('post', 'categories', 'image'));
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
        $request->validate([
            'post_title' => 'required',
            'category_id' => 'required',
            'post_body' => 'required',
            'is_featured' => 'required',
            'is_pinned' => 'required',
        ]);
        $input =  $request->all();
        // dd($input);
        // validate bulk image, if error flash message.
        if ($request->hasFile('post_image')){
            $image_handler = new FileHandler();
            $errors=$image_handler->validateImage([$input['post_image']]);

            if (!empty($errors) || !is_null($errors)) {
                session()->flash('message_danger', 
                'Please upload a valid image (jpg, jpeg, png, gif). <br>Invalid file : <b>'.$errors.'<b>');
                return back()->withInput();
            }
        }        
        
        $post->update([
            'post_title' => $input['post_title'],
            'category_id' => $input['category_id'],
            'post_body' => $input['post_body'],
            'user_id' => auth()->id(),
            'is_featured' => $input['is_featured'],
            'is_pinned' => $input['is_pinned'],
        ]);

        if (!$post) {
            session()->flash('message_danger', 'Post could not be updated.');
            return back();
        }

        // upload image
        if ($request->hasFile('post_image')) {
            $image_handler->uploadFile([$input['post_image']], $post->id, $this->image_bucket);
        }
        session()->flash('message_success', 'Post updated successfully.');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {        
        // get files of project
        $result = DB::select('select id,image_path from image_managers where foreign_id = ? and source =?', [$post->id, 'posts']);
        $files = json_decode(json_encode($result), true);

        // delete from storage
        $filee_handler = new FileHandler();
        $filee_handler->deleteFiles($files, $this->image_bucket, $this->disk);
        
        $post->delete();
        session()->flash('message_success', 'Project deleted');
        return back();
    }

    public function delete(Post $post){
        return view('backend.posts.delete', compact('post'));
    }

    // archive view
    public function archive(Post $post, $archive){
        return view('backend.posts.archive', compact('post', 'archive'));
        
    }

    // archive method
    public function archivePost(Post $post, $archive){
        $status = $archive =='archive' ? true : false;
        $post->update([
            'archive'=>$status
        ]);

        session()->flash('message_success', 'Post archived.');
        return back();
    }
}
