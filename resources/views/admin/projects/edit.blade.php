@extends('layouts.admin')

@section('content')
    <h1>Modifica progetto: {{$project->title}}</h1>

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
        <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
              <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo" value="{{old('title', $project->title)}}">
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">Descrizione</label>
                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Inserisci la descrizione del progetto">{{old('content', $project->content)}}</textarea>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control" id="image" name="image" value="{{old('image')}}">
                {{-- <div class="mb-3">
                  <label for="category_id" class="form-label">Categoria</label>
                  <select class="form-select" name="category_id" id="category_id">
                    <option value="">Senza Categoria</option>
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                  </select>
                </div> --}}
                {{-- <div class="mb-3">
                  @foreach($tags as $tag)
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}"{{in_array($tag->id, old('tags', [])) ? 'checked' : ""}}>
                      <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                    </div>
                  @endforeach
                </div> --}}
              <button type="submit" class="btn btn-success mt-5">Conferma</button>
        </form>
    </div>
    <a href="{{route('admin.projects.index')}}" class="btn btn-primary my-4">Torna alla Lista</a>
@endsection