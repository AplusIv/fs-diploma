<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Orders</title>
</head>
<body>
  <table class="table">
    <tr>
        <th>id</th>
        <th>sum</th>
        <th>is_paid</th>
    </tr>
    @foreach ($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->sum }}</td>
        <td>{{ $order->is_paid }}</td>
    </tr>
    @endforeach
  </table>
</body>
</html>