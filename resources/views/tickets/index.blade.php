<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tickets</title>
</head>
<body>
  <table class="table">
    <tr>
        <th>id</th>
        <th>session_id</th>
        <th>time</th>
        <th>place_id</th>
        <th>row</th>
        <th>place</th>
        <th>price</th>
        <th>is_free</th>
    </tr>
    @foreach ($tickets as $ticket)
    <tr>
        <td>{{ $ticket->id }}</td>
        <td>{{ $ticket->session_id }}</td>
        <td>{{ $ticket->session->time }}</td>
        <td>{{ $ticket->place_id }}</td>
        <td>{{ $ticket->place->row }}</td>
        <td>{{ $ticket->place->place }}</td>
        <td>{{ $ticket->place->price }}</td>
        <td>{{ $ticket->place->is_free }}</td>
    </tr>
    @endforeach
  </table>
</body>
</html>