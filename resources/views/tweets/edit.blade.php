<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Tweet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif
    <h1>Edit Tweet</h1>
        @foreach ($tweets as $tweet)

        <form action="/tweets/{{ $tweet->id }}/update" method="post">
        {{ csrf_field() }}
        <div class="form-group">

            <textarea  id="tweet" cols="50" rows ="10" name="tweet" >{{ "$tweet->tweet" }}</textarea>

    @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>


</body>
</html>

