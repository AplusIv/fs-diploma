<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Places</title>
</head>
<body>
  <table class="table">
    <tr>
        <th>id</th>
        <th>row</th>
        <th>place</th>
        <th>type</th>
        <th>is_free</th>
        <th>is_selected</td>
        <th>price</th>
        <th>hall_id</th>
        <th>hall title</th>
        <th>session_id</th>
        <th>session time</th>
        <th>ticket_id</th>
    </tr>
    @foreach ($places as $place)
    <tr>
        <td>{{ $place->id }}</td>
        <td>{{ $place->row }}</td>
        <td>{{ $place->place }}</td>
        <td>{{ $place->type }}</td>
        <td>{{ $place->is_free }}</td>
        <td>{{ $place->is_selected }}</td>
        {{-- <td>{{ $place->price }}</td> --}}
        {{-- @if ($place->type === 'vip') 
          <td>{{ $place->hall->vip_price }}</td>  
        @elseif ($place->type === 'normal')   
          <td>{{ $place->hall->normal_price }}</td>      
            @else
              <td>place is not allowed</td>  
        @endif --}}
        <td>{{ $place->price }}</td>
        <td>{{ $place->hall_id }}</td>
        <td>{{ $place->hall->title}}</td>
        <td>{{ $place->session_id }}</td>
        <td>{{ $place->session->time}}</td>
        @if ($place->ticket)
          <td>{{ $place->ticket->id }}</td>
        @else
          <td>no ticket</td> 
        @endif

    </tr>
    @endforeach
  </table>
</body>
</html>