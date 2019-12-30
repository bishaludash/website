<?php

namespace App\Http\Controllers\BE;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('cat_name')->get();
        return view('backend.category.index', compact('categories'));
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
            'cat_name'=>'required'
        ]);

        $input =  $request->only('cat_name');
        $cat_name =  strtolower($input['cat_name']);

        $cat_count = Category::where('cat_name', $cat_name)->first();
        if (!is_null($cat_count)) {
            session()->flash('message_danger', 'Category already exists.');
            return back();
        }

        Category::create([
            'cat_name'=>$cat_name
        ]);

        session()->flash('message_success', 'Category created');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        $category->update($input);

        session()->flash('message_success', 'Category updated.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (count($category->posts) > 0) {
            session()->flash('message_danger', $category->cat_name.' is used in post. Cannot delete.');
            return back();
        }

        $category->delete();
        session()->flash('message_success', $category->cat_name.' deleted.');
        return back();
    }

    public function delete(Category $category){
        return view('backend.category.delete', compact('category'));
    }
}
