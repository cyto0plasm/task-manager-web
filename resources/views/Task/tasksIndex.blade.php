@extends('layout')
@section('page-name', 'Tasks')

@section('main')
    <section id="mainSection" class="flex gap-6 justify-start min-h-screen p-6">
        <x-task-list :tasks="$tasks"></x-task-list>
        <x-task-details></x-task-details>
    </section>
@endsection
