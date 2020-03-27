@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
          <form method="POST" action="{{ route('getShortUrl') }}">   
            @csrf
            <div class="form-group">
                <label for="url">Введите URL для генерации короткой ссылки</label>
                <input type="text" class="form-control" id="name" name="url" required placeholder="URL" />
            </div>
            @if(Session::has('error'))   
              <div class="alert alert-danger" role="alert">
                <pre class="alert-danger"> {{ Session::get('error') }}</pre>
              </div>
            @endif
            @if(Session::has('shortUrl'))
                  <p>Ваша короткая ссылка: <a href="{{ Session::get('shortUrl') }}"> {{ Session::get('shortUrl') }}</a></p>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-outline-success">Сгенерировать</button>
            </div>
        </form>        
      </div>
    </div>
  </div>

@endsection