<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function add()
    {
        return view('auth.blog.insert');
    }
    
    public function create(Request $request)
    {
        // admin/news/createにリダイレクトする
        return redirect('auth/blog/insert');
    }
}
