<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Tweets</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    @if (session('successStatus'))
        <div class="alert alert-success" role="alert">
            {{ session('successStatus') }}
        </div>
    @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif

    <h1>Write a Tweet</h1>

    <form action="/tweets" method="post">
        {{ csrf_field() }}
        <div class="form-group">

            <input type="text" id="tweet" cols="50" rows ="10" name="tweet" value="{{ old('tweet') }}">

        </div>

        <button type="submit" class="btn btn-primary">Tweet</button>
    </form>

    <h1> All Tweets</h1>
    <table class="table">
        <thead>
        <tr>3
            <th>ID</th>
            <th>Tweet</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tweets as $tweet)
            <tr>
                <td>{{ $tweet->id  }}</td>
                <td>{{ $tweet->tweet }}</td>
                <td>
                    <a href="/tweets/{{ $tweet->id }}">
                        <button type="button" class="btn btn-link">
                            View
                         </button>
                </td>
                <td>
                    <a href="/tweets/{{ $tweet->id }}/delete">
                        <button type="button" class="btn btn-link">
                            X
                        </button>
                    </a>

                </td>
            </tr>

        </tbody>
        @endforeach
    </table>
</div>




</body>
</html>