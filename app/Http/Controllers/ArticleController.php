<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article/show')->withArticle(Article::with('hasManyComments')->find($id));
    }
}
