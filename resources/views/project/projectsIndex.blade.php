@extends('layout')
@section('page-name', 'Tasks')

<ul>
    @section('main')
        @foreach ($projects as $project)
            <li>
                {{ $project->name }}
            </li>
        @endforeach

    @endsection
</ul>
