<?php

namespace App\Http\Controllers;

use App\Models\Project;
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
        // $tasks=Task::all();
         $tasks = Task::with('project')->orderBy('position')->get();
        $projects = Project::all();

        $firstTask =$tasks->first();

        $taskStatusDoneCount=$tasks->where('status','done')->count();
        $taskStatusProgressCount=$tasks->where('status','in_progress')->count();
        $taskStatusPendingCount=$tasks->where('status','pending')->count();
       
       
        return view('Task.tasksIndex',[
            'tasks'=>$tasks,
            'firstTask'=>$firstTask ,
            'projects'=>$projects,
            'taskStatusDoneCount'=>$taskStatusDoneCount,
            'taskStatusProgressCount'=>$taskStatusProgressCount,
            'taskStatusPendingCount'=>$taskStatusPendingCount

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
       $task = Task::with('project')->find($id);

    if ($task && $task->project) {
        $task->project_name = $task->project->name; // Add convenience field
    }
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task=Task::findOrFail($id);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date'    => 'nullable|date',
        'priority'    => 'required|in:low,medium,high',
        'status'      => 'required|in:pending,in_progress,done',
        'project_id'  => 'nullable|exists:projects,id',
    ]);
    $task=Task::findOrFail($id);
            $task->update($validated);
return redirect()->back();

    }
public function updateStatus($id, Request $request)
{
    $task = Task::find($id);

    if (!$task) {
        return response()->json(['success' => false, 'message' => 'Task not found.']);
    }

    if ($task->status === 'done') {
        return response()->json(['success' => false, 'message' => 'This task is already marked as done.']);
    }

    $task->status = $request->input('status', 'done');
    $task->save();

    return response()->json(['success' => true, 'message' => 'Task marked as complete.']);
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
        
$tasks = Task::orderBy('position')->get();
        return view('Task.taskView',[
            'tasks'=>$tasks,
            
        ]);
    }
    public function reorder(Request $request)
{
    foreach ($request->order as $item) {
        \App\Models\Task::where('id', $item['id'])
            ->update(['position' => $item['position']]);
    }

    return response()->json(['status' => 'success']);
}

}