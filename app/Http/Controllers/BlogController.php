<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function add()
    {
        return view('admin.blog.insert');
    }
    
    public function create(Request $request)
    {
        // admin/news/createにリダイレクトする
        return redirect('admin/blog/insert');
    }
}
