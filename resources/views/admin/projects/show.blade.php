@extends('layouts.admin')

@section('content')
    <h1>{{$project->title}}</h1>
    {{-- Con il punto interrogativo prima del nome della proprietà si intende 'se esiste stampa se no non farlo' --}}
    {{-- <a href="{{route('admin.categories.show', $post->category)}}"><h3>{{$post->category?->name ?: 'Nessuna Categoria'}}</h3></a> --}}
    <p>{{$project->content}}</p>
    
    {{-- @if($project->tags)
        <div class="mb-3">
            @foreach($post->tags as $tag)
            <a href="{{route('admin.tags.show', $tag)}}"><span class="badge text-bg-success">{{$tag->name}}</span></a>
            @endforeach
        </div>
    @endif --}}
    
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