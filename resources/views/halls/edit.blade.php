<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create hall</title>
</head>
<body>
  <h1>Это блэйд halls.edit</h1>
  
  <a class="btn btn-primary" href="{{ route('halls.index') }}"> Назад</a>
  <br>

  <h3>Редактирование зала</h3>
    <form action="{{ route('halls.update', $hall->id) }}" method="post">
      @method('PUT')
      {{--  --}}
      @csrf
      {{--  --}}
      <div class="form-group">
        <label for="title">title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$hall->title}}">
      </div>
      <div class="form-group">
        <label for="rows">rows</label>
        <input type="number" value="{{$hall->rows}}" class="form-control" name="rows" id="rows">
      </div>
      <div class="form-group">
        <label for="places">places</label>
        <input type="number" value="{{$hall->places}}"class="form-control" name="places" id="places">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Обновить зал</button>
    </form>
    <br>
    <form action="{{ route('halls.destroy', $hall->id) }}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm">Удалить зал</button>
    </form>
</body>
</html>