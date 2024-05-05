<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Halls</title>
</head>
<body>
  {{-- <a class="navbar" href={{ route('welcome') }}>На главную</a>   --}}

  <table class="table">
    <tr>
        <th>id</th>
        <th>title</th>
        <th>rows</th>
        <th>places</th>
    </tr>
    @foreach ($halls as $hall)
    <tr>
        <td>{{ $hall->id }}</td>
        <td>{{ $hall->title }}</td>
        <td>{{ $hall->rows }}</td>
        <td>{{ $hall->places }}</td>
    </tr>
    @endforeach
  </table>
</body>
</html>