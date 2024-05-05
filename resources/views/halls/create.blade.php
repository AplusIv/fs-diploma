<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create hall</title>
</head>
<body>
  <h1>Это блэйд hall.create</h1>
  
  <a class="btn btn-primary" href="{{ route('halls.index') }}"> Назад</a>
  <br>

  <h3>Добавление зала</h3>
    <form action="{{ route('halls.store') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="title">title</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="form-group">
        <label for="rows">rows</label>
        <input type="number" value="10" class="form-control" name="rows" id="rows">
      </div>
      <div class="form-group">
        <label for="places">places</label>
        <input type="number" value="8" class="form-control" name="places" id="places">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Создать новый зал</button>
    </form>
</body>
</html>