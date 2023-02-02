@extends('layouts.admin')

@section('content')
    <h1>{{$project->title}}</h1>
    {{-- Con il punto interrogativo prima del nome della proprietà si intende 'se esiste stampa se no non farlo' --}}
    <a href="{{route('admin.types.show', $project->type)}}"><h3>{{$project->type?->name ?: 'Nessuna Tipologia'}}</h3></a>
    <a href="{{route('admin.fields.show', $project->field)}}"><h3>{{$project->field?->name ?: 'Nessuna Campo'}}</h3></a>
    
    <p>{{$project->content}}</p>
    
    @if($project->technologies)
        <div class="mb-3">
            @foreach($project->technologies as $technology)
            <a href="{{route('admin.technologies.show', $technology)}}"><span class="badge text-bg-success">{{$technology->name}}</span></a>
            @endforeach
        </div>
    @endif
    
    <div>
        <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning my-1 d-inline-block">Modifica</a>
        <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
    </div>
    <a href="{{route('admin.projects.index')}}" class="btn btn-primary my-1">Torna alla Lista</a>
@endsection