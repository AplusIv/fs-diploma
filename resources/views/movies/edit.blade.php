<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create movie</title>
</head>
<body>
  <h1>Это блэйд movies.edit</h1>
  
  <a class="btn btn-primary" href="{{ route('movies.index') }}"> Назад</a>
  <br>

  <h3>Редактирование фильма</h3>
    <form action="{{ route('movies.update', $movie->id) }}" method="post">
      @method('PUT')
      {{--  --}}
      @csrf
      {{--  --}}
      <div class="form-group">
        <label for="title">title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$movie->title}}">
      </div>
      <div class="form-group">
        <label for="description">description</label>
        <textarea id="description" name="description" rows="5" cols="35">{{$movie->description}}</textarea>
      </div>
      <div class="form-group">
        <label for="duration">duration</label>
        <input type="number" class="form-control" name="duration" id="duration" value="{{$movie->duration}}">
      </div>
      <div class="form-group">
        <label for="country">country</label>
        <input type="text" class="form-control" id="country" name="country" value="{{$movie->country}}">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Обновить фильм</button>
    </form>
    <br>
    <form action="{{ route('movies.destroy', $movie->id) }}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm">Удалить фильм</button>
    </form>
</body>
</html>