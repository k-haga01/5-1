<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでtweet Modelが扱えるようになる
use App\Tweet;

class TweetsController extends Controller
{
    public function add()
    {
        $posts = Tweet::all();
        return view('admin.sns.create',['posts' => $posts]);
    }

    public function create(Request $request)
    {

        // 以下を追記
        // Varidationを行う
        $this->validate($request, Tweet::$rules);

        $tweet = new Tweet;
        $form = $request->all();
        $tweet->user_id = $request->user()->id;


        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        // データベースに保存する
        $tweet->fill($form);
        $tweet->save();

        return redirect('admin/sns/create');
    }
}
