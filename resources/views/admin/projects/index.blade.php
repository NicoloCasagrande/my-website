@extends('layouts.admin')

@section('content')
    <h1>Lista Progetti</h1>
    
    {{-- gestione messaggi CRUD --}}
    @if(session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
    @endif
    <div class="my-3">
      <a href="{{route('admin.projects.create')}}" class="btn btn-primary">Crea un nuovo Progetto</a>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Titolo</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
          <tr>
            <td>{{$project->title}}</td>
            <td>{{$project->content}}</td>
            <td>
              <div class="d-flex align-items-center">
                <a href="{{route('admin.projects.show', $project)}}" class="btn btn-primary my-1 d-inline-block mx-1 main-post-button"><i class="fa-solid fa-eye"></i></a>
                <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning my-1 d-inline-block mx-1 main-post-button"><i class="fa-solid fa-pen"></i></a>
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger d-inline-block mx-1 main-post-button" data-bs-toggle="modal" data-bs-target="#modal-{{$project->id}}">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
          <!-- Modal -->
          <div class="modal fade" id="modal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Sei sicuro di voler eliminare la categoria "{{$project->title}}"
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                  <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Si</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>
    
@endsection