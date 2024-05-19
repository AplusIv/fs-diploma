<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit ticket</title>
</head>
<body>
  <h1>Это блэйд tickets.edit</h1>
  
  <a class="btn btn-primary" href="{{ route('tickets.index') }}"> Назад</a>
  <br>

  <h3>Редактирование билета</h3>
    <form action="{{ route('tickets.update', $ticket->id) }}" method="post">
      @method('PUT')
      {{--  --}}
      @csrf
      {{--  --}}

      <div class="form-group">
        <label for="place_id">place_id</label>
        <input type="number" value={{ $ticket->place_id }} class="form-control" name="place_id" id="place_id">
      </div>
      <div class="form-group">
        <label for="session_id">session_id</label>
        <input type="number" value={{ $ticket->session_id }} class="form-control" name="session_id" id="session_id">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Обновить билет</button>
    </form>
    <br>
    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm">Удалить билет</button>
    </form>
</body>
</html>