@extends('layouts.admin')

@section('content')
    <h1>{{$field->name}}</h1>
    <ul>
        @foreach ( $field->projects as $project )
            <li><a href="{{route('admin.projects.show', $project)}}">{{$project->title}}</a></li>
        @endforeach
    </ul>
    <div>
        <a href="{{route('admin.fields.edit', $field)}}" class="btn btn-warning my-1 d-inline-block">Modifica</a>
        <form action="{{route('admin.fields.destroy', $field)}}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
    </div>
    <a href="{{route('admin.types.index')}}" class="btn btn-primary my-1">Torna alla Lista</a>
@endsection