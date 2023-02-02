@extends('layouts.admin')

@section('content')
    <h1>Modifica Campo: {{$field->name}}</h1>

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
        <form action="{{route('admin.fields.update', $field)}}" method="POST">
            @csrf
            @method('PUT')
              <div class="mb-3">
                <label for="name" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il Nome" value="{{old('name', $field->name)}}">
              </div>
              <button type="submit" class="btn btn-success mt-5">Conferma</button>
        </form>
    </div>
    <a href="{{route('admin.fields.index')}}" class="btn btn-primary my-4">Torna alla Lista</a>
@endsection