<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create session</title>
</head>
<body>
  <h1>Это блэйд session.create</h1>
  
  <a class="btn btn-primary" href="{{ route('sessions.index') }}"> Назад</a>
  <br>

  <h3>Добавление сеанса</h3>
    {{-- <form action="{{ route('sessions.store', {{ $movie->find($movieId) }}, {{ $hall->find($hallId) }}) }}" method="post"> --}}

    <form action="{{ route('sessions.store') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="hall_id">hall_id</label>
        <input type="number" value={{ $hall->id }} class="form-control" name="hall_id" id="hall_id">
      </div>
      <div class="form-group">
        <label for="movie_id">movie_id</label>
        <input type="number" value={{ $movie->id }} class="form-control" name="movie_id" id="movie_id">
      </div>
      <div class="form-group">
        <label for="date">date</label>
        <input type="date" class="form-control" id="date" name="date">
      </div>
      <div class="form-group">
        <label for="time">time</label>
        <input type="time" class="form-control" id="time" name="time">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Создать новый сеанс</button>
    </form>
</body>
</html>