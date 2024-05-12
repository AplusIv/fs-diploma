<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sessions</title>
</head>
<body>
  <table class="table">
    <tr>
        <th>id</th>
        <th>date</th>
        <th>time</th>
        <th>movie_id</th>
        <th>movie title</th>
        <th>hall_id</th>
        <th>hall title</th>

    </tr>
    @foreach ($sessions as $session)
    <tr>
        <td>{{ $session->id }}</td>
        <td>{{ $session->date }}</td>
        <td>{{ $session->time }}</td>
        <td>{{ $session->movie_id }}</td>
        <td>{{ $session->movie->title}}</td>
        <td>{{ $session->hall_id }}</td>
        <td>{{ $session->hall->title}}</td>
    </tr>
    @endforeach
  </table>
</body>
</html>