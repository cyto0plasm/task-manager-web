<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $tasks=Task::all();
        return view('Task.tasksIndex',[
            'tasks'=>$tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('Task.tasksCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date'    => 'nullable|date',
        'priority'    => 'required|in:low,medium,high',
        'status'      => 'required|in:pending,in_progress,done',
        'project_id'  => 'nullable|exists:projects,id',
    ]);

    // Add creator_id manually (current logged in user)
    $validated['creator_id'] =  Auth::id();
//  dd($validated);
    Task::create($validated);

    return redirect()->route('tasks.index');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tasks=Task::find($id);
        return response()->json($tasks);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):View
    {
        return view('Task.tasksEdit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function view():View
    {
        return view('Task.taskView');
    }
}