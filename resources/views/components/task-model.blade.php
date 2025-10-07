{{-- resources/views/components/create-modal.blade.php --}}

@props([
    'projects' => [],
    'taskAction' => route('tasks.store'),
    'projectAction' => route('projects.store'),
])

<div id="create-modal">

    {{-- Floating Action Button --}}
    <div class="fixed bottom-8 right-8 z-50">
        {{-- Options Menu --}}
        <div id="fab-menu" class="hidden absolute bottom-20 right-0 flex flex-col gap-3 mb-2">
            <button onclick="openModal('project-modal'); toggleFabMenu(false)"
                class="flex items-center gap-3 bg-white text-gray-700 px-5 py-3 rounded-full shadow-lg hover:shadow-xl hover:bg-gray-50 transition-all whitespace-nowrap font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6b3eea]" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
                New Project
            </button>

            <button onclick="openModal('task-modal'); toggleFabMenu(false)"
                class="flex items-center gap-3 bg-white text-gray-700 px-5 py-3 rounded-full shadow-lg hover:shadow-xl hover:bg-gray-50 transition-all whitespace-nowrap font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#10B981]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                New Task
            </button>
        </div>

        {{-- Main FAB Button --}}
        <button onclick="toggleFabMenu()" id="fab-btn"
            class="bg-[#6b3eea] text-white p-4 rounded-full shadow-xl hover:bg-[#6935f7] hover:shadow-2xl active:bg-[#6335e0] transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </button>
    </div>

    {{-- Task Modal --}}
    <div id="task-modal" class="hidden fixed inset-0 z-50 flex items-center  p-4">
        <div onclick="closeModal('task-modal')" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <!-- Modal box -->
        <div class="lg:mx-[23%] mx-[5%]   relative bg-white rounded-l-2xl shadow-[0_4px_20px_rgba(0,0,0,0.3),-4px_0_20px_rgba(0,0,0,0.3)] max-w-lg w-full max-h-[96vh] flex flex-col"
            onclick="event.stopPropagation()">

            <!-- Sticky Header -->
            <div
                class="sticky top-0 bg-gradient-to-r from-[#10B981] to-[#34c796] text-white px-6 py-4 flex items-center justify-between">
                <h2 class="text-2xl font-bold">Create New Task</h2>
                <button onclick="closeModal('task-modal')"
                    class="text-white/80 hover:text-white hover:bg-white/20 rounded-lg p-1.5 transition-all">
                    ✕
                </button>
            </div>

            <!-- Scrollable Content -->
            <div id="task-window" class=" flex-1 overflow-y-auto px-6 py-8  ">

                <form action="{{ $taskAction }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <div id="form">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Task Title</label>
                            <input type="text" name="title" required
                                class="w-full px-4 py-3 border-[#4cd9aa] rounded-xl focus:ring-2 focus:ring-[#4cd9aa] focus:border-none" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="3"
                                class="w-full px-4 py-3 border-[#4cd9aa] rounded-xl focus:ring-2 focus:ring-[#4cd9aa] focus:border-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Due Date</label>
                            <input type="date" name="due_date"
                                class="w-full px-4 py-3 border-[#4cd9aa] rounded-xl focus:ring-2 focus:ring-[#4cd9aa] focus:border-none" />
                        </div>

                        <div class="flex justify-between gap-6 mt-2 mb-4">
                            <!-- Priority -->
                            <div class="w-1/2">
                                <label for="priority"
                                    class="block text-sm font-semibold text-gray-700 mb-2">Priority</label>
                                <select name="priority" id="priority"
                                    class="w-full px-4 py-3 border-[#4cd9aa] rounded-xl focus:ring-2 focus:ring-[#4cd9aa] focus:border-none">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="w-1/2">
                                <label for="status"
                                    class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                <select name="status" id="status"
                                    class="w-full px-4 py-3 border-[#4cd9aa] rounded-xl focus:ring-2 focus:ring-[#4cd9aa] focus:border-none">
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                        </div>
                        <!-- Projects picker -->
                        <div class="mt-4">

                            <!-- Mobile: collapsible list -->
                            <details class="block md:hidden bg-white border rounded-xl">
                                <summary class="font-bold text-md px-4 py-3 cursor-pointer">Add To A Project</summary>
                                <ul class="mt-2 divide-y">
                                    @foreach ($projects as $project)
                                        <label class="block cursor-pointer">
                                            <input type="radio" name="project_id" value="{{ $project->id }}"
                                                class="hidden peer" />
                                            <li
                                                class="px-2 py-3 hover:bg-gray-200 transition-all duration-200 truncate peer-checked:bg-gray-300">
                                                {{ $project->name }}
                                            </li>
                                        </label>
                                    @endforeach
                                </ul>
                            </details>
                        </div>
                        <!-- Desktop: floating right panel -->
                        <div
                            class="hidden md:flex flex-col absolute bg-white top-0 left-[calc(100%+0px)] h-full rounded-r-xl w-[250px] px-3 pt-3 pb-8 z-30 border-l-2 border-gray-200">

                            <!-- Header -->
                            <h2 class="font-bold text-lg pt-2 text-center border-b border-gray-200">
                                Add To A Project
                            </h2>

                            <!-- Project list -->
                            <ul class="project-list mt-2 flex-1 max-h-full overflow-y-auto pr-2 space-y-1">
                                @forelse ($projects as $project)
                                    <label class="block cursor-pointer">
                                        <input type="radio" name="project_id" value="{{ $project->id }}"
                                            class="hidden peer" />
                                        <li
                                            class="list-none px-2 py-3 rounded-md hover:bg-gray-100 transition-all duration-200 truncate peer-checked:bg-[#6B3EEA] peer-checked:text-white">
                                            {{ $project->name }}
                                        </li>
                                    </label>
                                @empty
                                    <li class="list-none px-2 py-3 text-gray-500 italic">
                                        You don’t have Projects Yet
                                        <button class="text-[#6B3EEA] underline"
                                            onclick="openModal('project-modal'); toggleFabMenu(false)">
                                            Create Your First Project
                                        </button>
                                    </li>
                                @endforelse
                            </ul>

                            <!-- Footer button -->
                            <div class="pt-3  border-t border-gray-200">
                                <x-a onclick="openModal('project-modal'); toggleFabMenu(false)" text="Create Project"
                                    class="text-center w-full "></x-a>
                            </div>
                        </div>

                    </div>

                    <div class="flex gap-3 pt-3  justify-end  ">
                        <x-button type="button" onclick="closeModal('task-modal')" text="Cancel"
                            bgColor="bg-inherit" textColor='text-black' hoverText="hover:text-white"
                            activeText="active:text-gray-300" hoverColor="hover:bg-gray-700"
                            activeColor="active:bg-gray-800"></x-button>
                        <x-button type="submit" text="Create Task" bgColor="bg-[#27C28F]" hoverColor="bg-"
                            activeColor="bg-[#37bf92]" textColor="text-white"></x-button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    {{-- Project Modal --}}
    <div id="project-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div onclick="closeModal('project-modal')" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <!-- Modal box -->
        <div class="relative bg-white  shadow-2xl max-w-lg w-full max-h-[96vh] flex flex-col"
            onclick="event.stopPropagation()">

            <!-- Sticky Header -->
            <div
                class="sticky top-0 bg-gradient-to-r from-[#6b3eea] to-[#8b5cf6] text-white px-6 py-4 flex items-center justify-between">
                <h2 class="text-2xl font-bold">Create New Project</h2>
                <button onclick="closeModal('project-modal')"
                    class="text-white/80 hover:text-white hover:bg-white/20 rounded-lg p-1.5 transition-all">
                    ✕
                </button>
            </div>

            <!-- Scrollable Content -->
            <div id="project-window" class="flex-1 overflow-y-auto px-6 py-8">
                <form action="{{ $projectAction }}" method="POST" class="space-y-3">

                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Project Title</label>
                        <input type="text" name="name" required
                            class="w-full px-4 py-3 border-[#6b3eea] rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-none" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-3 border-[#6b3eea] rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-none"></textarea>
                    </div>

                    <!-- Dates side by side -->
                    <div class="flex gap-6">
                        <div class="w-1/2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                            <input type="date" name="start_date"
                                class="w-full px-4 py-3 border-[#6b3eea] rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-none" />
                        </div>

                        <div class="w-1/2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date"
                                class="w-full px-4 py-3 border-[#6b3eea] rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-none" />
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="w-1/2">
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-3 border-[#6b3eea] rounded-xl focus:ring-2 focus:ring-[#6b3eea] focus:border-none">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-2 justify-end">
                        <x-button type="button" onclick="closeModal('project-modal')" text="Cancel"
                            bgColor="bg-inherit" textColor='text-black' hoverText="hover:text-white"
                            activeText="active:text-gray-300" hoverColor="hover:bg-gray-700"
                            activeColor="active:bg-gray-800"></x-button>
                        <x-button type="submit" text="Create Project" bgColor="bg-[#6b3eea]"
                            activeColor="bg-[#5c2fd1]" textColor="text-white"></x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<script src="{{ asset('js/tasks/editTask.js') }}"></script>

<style>
    #task-window::-webkit-scrollbar {
        width: 8px;
        /* scrollbar width */
    }

    #task-window::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* track color */
        border-radius: 10px;
    }

    #task-window::-webkit-scrollbar-thumb {
        background-color: #9ca3af;
        /* thumb color (gray-400 from Tailwind) */
        border-radius: 10px;
        border: 2px solid #f1f1f1;
        /* adds space around thumb */
    }

    #task-window::-webkit-scrollbar-thumb:hover {
        background-color: #4b5563;
        /* darker on hover (gray-600) */
    }
</style>
