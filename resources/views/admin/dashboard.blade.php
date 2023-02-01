@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center">Dashboard</h1>
            <div>
                <h3>Numero di post: {{count($projects)}}</h3>
                @if(count($projects) !== 0)
                    <ul>
                        @foreach($projects as $project)
                            <li><a href="{{route('admin.projects.show', $project)}}">{{$project->title}}</a></li>
                        @endforeach
                    </ul>
                @endif
                <h3>Numero di categorie: {{count($types)}}</h3>
                @if(count($types) !== 0)
                    <ul>
                        @foreach($types as $type)
                            <li><a href="{{route('admin.types.show', $type)}}">{{$type->name}}</a></li>
                        @endforeach
                    </ul>
                @endif
                <h3>Numero di tag: {{count($technologies)}}</h3>
                @if(count($technologies) !== 0)
                    <ul>
                        @foreach($technologies as $technology)
                            <li><a href="{{route('admin.technologies.show', $technology)}}">{{$technology->name}}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
