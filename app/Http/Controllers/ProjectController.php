<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class ProjectController extends Controller
{
public function index():View {
    $projects=Project::all();
    return view('project.projectsIndex',['projects'=>$projects]);
}
public function create(Request $request) {
  
}

    //store project
    public function store(Request $request) {
          $validated =$request->validate([
          'name'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date'    => 'nullable|date',
        'end_date'    => 'nullable|date',
        'status'      => 'required|in:pending,in_progress,done',
    ]);
        $validated['creator_id'] =  Auth::id();

        Project::create($validated);

    return redirect()->back();
    }

    //show project
    public function show(Request $request) {}

    //update project
    public function update($id):View {
        return view('project.projectEdit');
    }
    //edit project
    public function edit(Request $request, $id) {
       
    }
    //delete project
    public function delete($id) {}

    public function view() {
        return view('project.projectView');
    }
}