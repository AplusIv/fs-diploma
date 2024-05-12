<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Show hall</title>
</head>
<body>
  <table class="table">
    <tr>
      <th>id</th>
      <th>title</th>
      <th>rows</th>
      <th>places</th>
      <th>normal_price</td>
      <th>vip_price</td>
    </tr>
    <tr>
      <td>{{ $hall->id }}</td>
      <td>{{ $hall->title }}</td>
      <td>{{ $hall->rows }}</td>
      <td>{{ $hall->places }}</td>
      <td>{{ $hall->normal_price }}</td>
      <td>{{ $hall->vip_price }}</td>
    </tr>
  </table>
</body>
</html>