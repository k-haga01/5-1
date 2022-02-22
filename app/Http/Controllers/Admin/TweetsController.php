<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでtweet Modelが扱えるようになる
use App\Tweet;
use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    public function add()
    {
        $auths = Auth::user();
        $posts = Tweet::all();

        return view('admin.sns.create', ['posts' => $posts,'current_user_id' => $auths->id]);//postsという名前で$postsの中身を指定のパスに飛ばしている
    }

    public function create(Request $request)
    {
        // 以下を追記
        // Varidationを行う
        $this->validate($request, Tweet::$rules);

        $tweet = new Tweet;
        $form = $request->all();
        $tweet->user_id = $request->user()->id;

        // ログインしているユーザー情報取得
        $auths = Auth::user();
        dd($auths);


        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        // データベースに保存する
        $tweet->fill($form);
        $tweet->save();

        return redirect('admin/sns/create');
    }
    public function delete(Request $request)
    {
        $tweet = Tweet::find($request->id);

        $tweet->delete();
        return redirect('admin/sns/create');
    }
}
