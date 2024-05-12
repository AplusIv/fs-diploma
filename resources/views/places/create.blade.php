<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create place</title>
</head>
<body>
  <h1>Это блэйд place.create</h1>
  
  <a class="btn btn-primary" href="{{ route('places.index') }}"> Назад</a>
  <br>

  <h3>Добавление места</h3>
    {{-- <form action="{{ route('sessions.store', {{ $movie->find($movieId) }}, {{ $hall->find($hallId) }}) }}" method="post"> --}}

    <form action="{{ route('places.store') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="hall_id">hall_id</label>
        <input type="number" value="1" class="form-control" name="hall_id" id="hall_id">
      </div>
      <div class="form-group">
        <label for="session_id">session_id</label>
        <input type="number" value="1" class="form-control" name="session_id" id="session_id">
      </div>
      <div class="form-group">
        <label for="row">row</label>
        <input type="number" class="form-control" id="row" name="row">
      </div>
      <div class="form-group">
        <label for="place">place</label>
        <input type="number" class="form-control" id="place" name="place">
      </div>
      <div class="form-group">
        <label for="type">type</label>
        <input type="text" class="form-control" id="type" name="type">
      </div>
      <div class="form-group">
        <label for="is_free">is_free</label>
        <input type="hidden" id="is_free" name="is_free" value="occupied">
        <input type="checkbox" id="is_free" name="is_free" value="free" checked>
      </div>
      {{-- <div class="form-group">
        <label for="price">price</label>
        <input type="number" step="0.01" value="300.50" class="form-control" id="price" name="price">
      </div> --}}
      <br>
      <button type="submit" class="btn btn-primary">Создать новое место</button>
    </form>
</body>
</html>