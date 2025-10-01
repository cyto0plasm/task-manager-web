@extends('layout')
@section('page-name', 'Tasks')

@section('main')
    create task
    <form action="">
        <x-input name="Title" placeholder="Task Title"></x-input>
        <x-input name="description" placeholder="Task description"></x-input>
        <input type="date" name="due_date" id="">
        <select name="priority" id=""></select>
        <select name="state" id=""></select>
        <select name="project" id=""></select>

        <x-button text="Create Task" type="submit" />
        <x-task-model />

    </form>

@endsection
