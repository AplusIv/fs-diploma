<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create order</title>
</head>
<body>
  <h1>Это блэйд order.create</h1>
  
  <a class="btn btn-primary" href="{{ route('orders.index') }}"> Назад</a>
  <br>

  <h3>Добавление заказа</h3>
    {{-- <form action="{{ route('sessions.store', {{ $movie->find($movieId) }}, {{ $hall->find($hallId) }}) }}" method="post"> --}}
    {{ $tickets }}

    <form action="{{ route('orders.store') }}" method="post">
      @csrf
      {{-- <div class="form-group">
        <label for="place_id">place_id</label>
        <input type="number" value="1" class="form-control" name="place_id" id="place_id">
      </div>
      <div class="form-group">
        <label for="session_id">session_id</label>
        <input type="number" value="1" class="form-control" name="session_id" id="session_id">
      </div> --}}
      <br>
      <button type="submit" class="btn btn-primary">Создать заказ</button>
    </form>
</body>
</html>