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
                <label for="cover_image" class="form-label">Immagine</label>
                <div class="mb-2">
                  <img width="100" id="output" @if($project->cover_image) src="{{asset("storage/$project->cover_image")}}" @endif>
                  <script>
                    var loadFile = function(event) {
                      var output = document.getElementById('output');
                      output.src = URL.createObjectURL(event.target.files[0]);
                      output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                      }
                    };
                  </script>
                </div>
                  @if($project->cover_image)
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" id="no_image" name="no_image">
                      <label class="form-check-label" for="no_image">Nessuna immagine</label>
                    </div>
                  @endif
                  <input type="file" class="form-control" id="cover_image" name="cover_image" value="{{old('cover_image')}}" onchange="loadFile(event)">          
                  <script>
                    const inputCheckbox = document.getElementById('no_image');
                    const inputFile = document.getElementById('cover_image');
                    inputCheckbox.addEventListener('change', function() {
                      if( inputCheckbox.checked ) {
                        inputFile.disabled = true;
                      } else {
                        inputFile.disabled = false;
                      }
                    });
                  </script>
                </div>
                <div class="mb-3">
                  <label for="type_id" class="form-label">Tipologia</label>
                  <select class="form-select" name="type_id" id="type_id">
                    <option value="">Senza Tipologia</option>
                    @foreach ($types as $type)
                      <option value="{{$type->id}}" {{old('type_id', $project->type_id) == $type->id ? 'selected' : ''}} >{{$type->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="field_id" class="form-label">Campo</label>
                  <select class="form-select" name="field_id" id="field_id">
                    <option value="">Senza Campo</option>
                    @foreach ($fields as $field)
                      <option value="{{$field->id}}" {{old('field_id', $project->field_id) == $field->id ? 'selected' : ''}} >{{$field->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  @foreach($technologies as $technology)
                  <div class="form-check form-check-inline">
                    @if($errors->any())
                      <input class="form-check-input" type="checkbox" id="{{$technology->slug}}" name="technologies[]" value="{{$technology->id}}"{{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                    @else
                      <input class="form-check-input" type="checkbox" id="{{$technology->slug}}" name="technologies[]" value="{{$technology->id}}"{{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                    @endif
                    <label class="form-check-label" for="{{$technology->slug}}">{{$technology->name}}</label>
                  </div>
                @endforeach
                </div>
              <button type="submit" class="btn btn-success mt-5">Conferma</button>
        </form>
    </div>
    <a href="{{route('admin.projects.index')}}" class="btn btn-primary my-4">Torna alla Lista</a>
@endsection