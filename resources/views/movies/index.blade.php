<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Movies</title>
</head>
<body>
  {{-- <a class="navbar" href={{ route('welcome') }}>На главную</a>   --}}

  <table class="table">
    <tr>
        <th>id</th>
        <th>title</th>
        <th>description</th>
        <th>duration</th>
        <th>country</th>
    </tr>
    @foreach ($movies as $movie)
    <tr>
        <td>{{ $movie->id }}</td>
        <td>{{ $movie->title }}</td>
        <td>{{ $movie->description }}</td>
        <td>{{ $movie->duration }}</td>
        <td>{{ $movie->country }}</td>
    </tr>
    @endforeach
  </table>
</body>
</html>