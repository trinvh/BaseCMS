<?php

namespace App\Http\Controllers\Backend\Blog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Blog\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(20);
        return view('backend.blogs.posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $post->status = true;
        $post->private = false;

        $categories = Category::getListsForSelect();
        return view('backend.blogs.posts.create')->withPost($post)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Post::getRules());

        $inputs = $request->all();
        $inputs['user_id'] = $request->user()->id;

        $post = Post::create($inputs);

        $post->categories()->sync($request->get('categories'));

        return redirect()->route('admin.blog.posts.index')->withFlashSuccess("Saved successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::getListsForSelect();
        return view('backend.blogs.posts.edit', compact(['post', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Post::getRules());

        $inputs = $request->all();

        $post = Post::findOrFail($id);

        $post->fill($inputs);
        $post->save();

        $post->categories()->sync($request->get('categories'));

        return redirect()->route('admin.blog.posts.index')->withFlashSuccess("Saved successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('admin.blog.posts.index')->withFlashSuccess("Deleted successfully");
    }
}
