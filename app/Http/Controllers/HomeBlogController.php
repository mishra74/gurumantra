<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;


class HomeBlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::where('status', 1)->latest()->get();
        return view('blogs', compact('blogs'));
    }

    public function blog_show($id)
    {
        $blog = Blog::find($id);
        return view('blog_show', compact('blog'));
    }
}
