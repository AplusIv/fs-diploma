<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create session</title>
</head>
<body>
  <h1>Это блэйд sessions.edit</h1>
  
  <a class="btn btn-primary" href="{{ route('sessions.index') }}"> Назад</a>
  <br>

  <h3>Редактирование сеанса</h3>
    <form action="{{ route('sessions.update', $session->id) }}" method="post">
      @method('PUT')
      {{--  --}}
      @csrf
      {{--  --}}
      <div class="form-group">
        <label for="hall_id">hall_id</label>
        <input type="number" value={{ $session->hall_id }} class="form-control" name="hall_id" id="hall_id">
      </div>
      <div class="form-group">
        <label for="movie_id">movie_id</label>
        <input type="number" value={{ $session->movie_id }} class="form-control" name="movie_id" id="movie_id">
      </div>
      <div class="form-group">
        <label for="date">date</label>
        <input type="date" value={{ $session->date }} class="form-control" id="date" name="date">
      </div>
      <div class="form-group">
        <label for="time">time</label>
        <input type="time" value={{ $session->time }} class="form-control" id="time" name="time">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Обновить сеанс</button>
    </form>
    <br>
    <form action="{{ route('sessions.destroy', $session->id) }}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm">Удалить сеанс</button>
    </form>
</body>
</html>