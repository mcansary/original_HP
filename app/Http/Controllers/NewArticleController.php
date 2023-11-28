<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewArticleController extends Controller
{
    //
    public function add()
    {
        return view('auth.newarticle.insert');
    }
}
