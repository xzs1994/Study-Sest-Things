<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;

class ArticleController extends Controller
{
    //
    public function index()
    {
        return view('admin.article.index')->withArticles(Article::all());
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',//required：必填
        ]);

        $article = new Article;
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->user_id = $request->user()->id;

        if ($article->save()) {
            return redirect('admin/articles');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function edit(Request $request, $id)
    {
        if ('post' == $request->isMethod('POST')) {

            $this->validate($request, [
                'title' => 'required|unique:articles|max:255',
                'body' => 'required',//required：必填
            ]);

            $article = new Article;
            $article->title = $request->get('title');
            $article->body = $request->get('body');
            $article->user_id = $request->user()->id;

            if ($article->update()) {
                return redirect('admin.index');
            } else {
                return redirect()->back()->withInput()->withErrors('编辑失败');
            }
        }

        return view('admin.article.edit')->withArticle(Article::find($id));
    }

    public function destroy($id)
    {
        Article::query()->find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
