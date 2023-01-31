@extends('layouts.admin')

@section('content')
    <h1>{{$type->name}}</h1>
    <ul>
        @foreach ( $type->projects as $project )
            <li><a href="{{route('admin.projects.show', $project)}}">{{$project->title}}</a></li>
        @endforeach
    </ul>
    <div>
        <a href="{{route('admin.types.edit', $type)}}" class="btn btn-warning my-1 d-inline-block">Modifica</a>
        <form action="{{route('admin.types.destroy', $type)}}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
    </div>
    <a href="{{route('admin.types.index')}}" class="btn btn-primary my-1">Torna alla Lista</a>
@endsection