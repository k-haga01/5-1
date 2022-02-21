<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyTweets</title>
</head>

<body>
    @extends('layouts.admin')
    @section('title', 'Mutter')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h4>Mutter</h4>
                <form action="{{ action('Admin\TweetsController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="body">つぶやき</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="body" value="{{ old('body') }}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
                <div>
                    <h2>ニュース一覧</h2>
                </div>
                <div class="row">
                    <div class="list-news col-md-12 mx-auto">
                        <div class="row">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th width="10%">ID</th>
                                        <th width="50%">本文</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $tweet)
                                    <tr>
                                        <th>{{ $tweet->user->name }}</th>
                                        <td>{{ $tweet->created_at }}</td>
                                        <td>{{ str_limit($tweet->body, 250) }}</td>
                                        <td>
                                        <div>
                                        @if()
                                            <a href="{{ action('Admin\TweetsController@delete', ['id' => $tweet->id]) }}">削除</a>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endsection
</body>

</html>
