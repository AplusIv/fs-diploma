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

  {{-- @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif --}}

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
      <div class="form-group">
        <label for="normal_price">normal_price</label>
        {{-- <input type="number" step="0.01" value="300.00" class="form-control" name="normal_price" id="normal_price"> --}}
        <input type="number" value="300" class="form-control" name="normal_price" id="normal_price">
      </div>
      <div class="form-group">
        <label for="vip_price">vip_price</label>
        {{-- <input type="number" step="0.01" value="500.50"class="form-control" name="vip_price" id="vip_price"> --}}
        <input type="number" value="500" class="form-control" name="vip_price" id="vip_price">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Создать новый зал</button>
    </form>
</body>
</html>