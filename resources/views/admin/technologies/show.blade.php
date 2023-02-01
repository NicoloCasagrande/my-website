@extends('layouts.admin')

@section('content')
    <h1>{{$technology->name}}</h1>
    <ul>
        @foreach ( $technology->projects as $project )
            <li><a href="{{route('admin.projects.show', $project)}}">{{$project->title}}</a></li>
        @endforeach
    </ul>
    <div>
        <a href="{{route('admin.technologies.edit', $technology)}}" class="btn btn-warning my-1 d-inline-block">Modifica</a>
        {{-- <form action="{{route('admin.technologies.destroy', $technology)}}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form> --}}
    </div>
    <a href="{{route('admin.technologies.index')}}" class="btn btn-primary my-1">Torna alla Lista</a>
@endsection