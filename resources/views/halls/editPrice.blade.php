<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit hall's prices</title>
</head>
<body>
  <h1>Это блэйд halls.editPrice</h1>
  
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

  <h3>Редактирование цен зала {{ $hall->id }}</h3>
    <form action="{{ route('halls.updatePrice', $hall->id) }}" method="post">
      @method('PATCH')
      {{--  --}}
      @csrf
      {{--  --}}
      <div class="form-group">
        <label for="normal_price">normal_price</label>
        <input type="number" step="0.01" value="{{ $hall->normal_price }}" class="form-control" name="normal_price" id="normal_price">
      </div>
      <div class="form-group">
        <label for="vip_price">vip_price</label>
        <input type="number" step="0.01" value="{{ $hall->vip_price }}"class="form-control" name="vip_price" id="vip_price">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Обновить цены зала</button>
    </form>
</body>
</html>