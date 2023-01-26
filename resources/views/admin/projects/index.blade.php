@extends('layouts.admin')

@section('content')
    <h1>Lista Progetti</h1>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $project)
          <tr>
            <td>{{$project->title}}</td>
            <td>{{$project->content}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    
@endsection