<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit type of place</title>
</head>
<body>
  <h1>Это блэйд places.editType</h1>
  
  <a class="btn btn-primary" href="{{ route('places.index') }}"> Назад</a>
  <br>

  <h3>Редактирование типа места {{ $place->place }} ряд {{ $place->row }}</h3>
    <form action="{{ route('halls.updateType', $place->id) }}" method="post">
      @method('PATCH')
      {{--  --}}
      @csrf
      {{--  --}}
      <div class="form-group">
        <label for="type">type</label>
        <input type="text" value={{ $place->type }} class="form-control" id="type" name="type">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Обновить тип места</button>
    </form>
</body>
</html>