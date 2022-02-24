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
    @section('title', 'home')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h4>ホーム</h4>
                <form action="{{ action('Admin\TweetsController@create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="body" value="{{ old('body') }}" placeholder="いまどうしてる？">
                        </div>
                    </div>
                    <!-- {{ csrf_field() }} -->
                    <input type="submit" class="btn btn-primary" value="つぶやく">
                </form>
                <div class="row">
                    <div class="list-news col-md-12 mx-auto">
                        <div class="row">
                            <table class="table table-dark">
                                <tbody>
                                    @foreach($posts as $tweet)
                                    <tr>
                                        <th>{{ $tweet->user->name }}</th>
                                        <td>{{ $tweet->created_at }}</td>
                                        <td>{{ str_limit($tweet->body, 250) }}</td>
                                        <td>
                                            <div>
                                                @if($current_user_id == $tweet->user_id)
                                                <a href="{{ action('Admin\TweetsController@delete', ['id' => $tweet->id]) }}">削除</a>
                                                @endif
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
