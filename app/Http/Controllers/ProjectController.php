<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
public function index():View {
    return view('project.projectsIndex');
}
public function create():View {
    return view('project.projectCreate');}

    //store project
    public function store(Request $request) {}

    //show project
    public function show(Request $request) {}

    //update project
    public function update($id):View {
        return view('project.projectEdit');
    }
    //edit project
    public function edit(Request $request, $id) {}
    //delete project
    public function delete($id) {}

    public function view() {
        return view('project.projectView');
    }
}