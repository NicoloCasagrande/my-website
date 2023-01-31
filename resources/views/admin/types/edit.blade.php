@extends('layouts.admin')

@section('content')
    <h1>Modifica Tipologia: {{$type->name}}</h1>

    {{-- gestione degli errori di validazione --}}
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="list-unstyled">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    {{-- /gestione degli errori di validazione --}}
    <div>
        <form action="{{route('admin.types.update', $type)}}" method="POST">
            @csrf
            @method('PUT')
              <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il Nome" value="{{old('title', $type->name)}}">
              </div>
              <button type="submit" class="btn btn-success mt-5">Conferma</button>
        </form>
    </div>
    <a href="{{route('admin.types.index')}}" class="btn btn-primary my-4">Torna alla Lista</a>
@endsection