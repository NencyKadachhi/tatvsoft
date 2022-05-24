<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogCreateRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCreateRequest $request)
    {
        $fileName = '';
        if ($request->hasFile('file')) {
            $file  = $request->file;
            $extension = $file->getClientOriginalExtension();
            $filePath = public_path('/blog/');
            $fileName = time() . '.' . $extension;
            $file->move($filePath, $fileName);
        }
        $tags = explode(',', $request->tags);

        if (!empty($request)) {
            $blog = new Blog;
            $blog->user_id = auth()->user()->id;
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->tags = $request->tags;
            $blog->image = '/blog/' . $fileName;
            if ($blog->save()) {
                foreach ($tags as $tag) {
                    $blog_tag = new BlogTag;
                    $blog_tag->blog_id = $blog->id;
                    $blog_tag->tag_name = $tag;
                    $blog_tag->save();
                }
            }
            return redirect()->route('dashboard')->withSuccess('Blog Created Successfully!');
        }
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
        $blog = Blog::find($id);
        $blog_tag = BlogTag::where('blog_id', $blog->id)->get();
        return view('blog.edit', compact('blog', 'blog_tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogUpdateRequest $request, $id)
    {
        $fileName = '';
        if ($request->hasFile('file')) {
            $file  = $request->file;
            $extension = $file->getClientOriginalExtension();
            $filePath = public_path('/blog/');
            $fileName = time() . '.' . $extension;
            $file->move($filePath, $fileName);
        }
        $tags = explode(',', $request->tags);

        if (!empty($request)) {
            $blog = Blog::find($id);
            $blog_tag_delete = BlogTag::where('blog_id', $id)->delete();
            $blog->user_id = auth()->user()->id;
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->tags = $request->tags;
            if ($request->hasFile('file')) {
                $blog->image = '/blog/' . $fileName;
            }
            $blog->image = $blog->image;
            if ($blog->save()) {
                foreach ($tags as $tag) {
                    $blog_tag = new BlogTag;
                    $blog_tag->blog_id = $blog->id;
                    $blog_tag->tag_name = $tag;
                    $blog_tag->save();
                }
            }
            return redirect()->route('dashboard')->withSuccess('Blog Updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!empty($blog)) {
            BlogTag::where('blog_id', $id)->delete();
            $blog->delete();

            return redirect()->route('dashboard')->withSuccess('Blog Deleted Successfully!');
        }
    }
}
