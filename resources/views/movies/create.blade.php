<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create movie</title>
</head>
<body>
  <h1>Это блэйд movie.create</h1>
  
  <a class="btn btn-primary" href="{{ route('movies.index') }}"> Назад</a>
  <br>

  <h3>Добавление фильма</h3>
    <form action="{{ route('movies.store') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="title">title</label>
        <input type="text" placeholder="Введите название фильма" class="form-control" id="title" name="title">
      </div>
      <div class="form-group">
        <label for="description">description</label>
        <textarea id="description" name="description" rows="5" cols="35" placeholder="Введите описание фильма"></textarea>
      </div>
      <div class="form-group">
        <label for="duration">duration</label>
        <input type="number" value="120" class="form-control" name="duration" id="duration">
      </div>
      <div class="form-group">
        <label for="country">country</label>
        <input type="text" placeholder="Введите страну" class="form-control" id="country" name="country">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Создать новый фильм</button>
    </form>
</body>
</html>