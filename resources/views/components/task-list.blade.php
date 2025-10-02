@props(['tasks' => collect()])

<!-- Tasks List Panel -->
<div id="tasksList" class="w-[28rem] bg-white rounded-lg shadow-md h-fit">
    <div class="border-b border-gray-200 px-6 py-4">
        <h2 class="text-center text-2xl font-bold text-gray-800">Tasks List</h2>
        <div class="flex justify-center gap-4 mt-2 text-sm text-gray-500">
            <span class="flex items-center gap-1">
                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                Completed
            </span>
            <span class="flex items-center gap-1">
                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                In Progress
            </span>
            <span class="flex items-center gap-1">
                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                Pending
            </span>
        </div>
    </div>

    <ul class="p-0 max-h-[70vh] overflow-y-auto">
        @foreach ($tasks as $task)
            <x-task-button :state="$task->status" :title="$task->title" :task-id="$task->id" :url="route('tasks.show', $task->id)" />
        @endforeach

    </ul>
</div>

<script src="{{ asset('js/tasks/switchTask.js') }}"></script>
