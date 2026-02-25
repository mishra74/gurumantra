<?php

namespace App\Http\Controllers;

use App\Models\DailyCurrent;

class PostController extends Controller
{
    public function show($id)
    {
        $post = DailyCurrent::findOrFail($id);
        return view('post.show', compact('post'));
    }
}
