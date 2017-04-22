<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Tweet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tweet</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tweets as $tweet)
                <tr>
                    <td>{{ $tweet->id }}</td>
                    <td>{{ $tweet->tweet }}</td>
                </tr>

            </tbody>

        </table>

        <a href="/tweets/{{ $tweet->id }}/edit">
            <button type="button" class="btn btn-link">
                Edit
            </button>
        </a>


        <a href="/" class="btn">Return</a>

    </div>
    @endforeach

</body>
</html>